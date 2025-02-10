@extends('layouts.base_admin')
@section('styles')
    <script src="{{ asset('assets/js/sdk.min.js') }}"></script>
    <script>
        window.METERED_DOMAIN = "{{ $METERED_DOMAIN }}";
        window.MEETING_ID = "{{ $MEETING_ID }}";
    </script>

    {{-- <link rel="manifest" href="{{ asset('build/manifest.json') }}"> --}}
    <style>
        .hidden {
            display: none !important;
        }

        .area {
            height: 100vh;
        }

        .video {
            object-fit: contain;
            width: 100%;
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
        }

        .video_participante {
            position: absolute;
            height: 2rem;
            width: 100%;
            background-color: #040c1c;
            border-bottom-left-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
            bottom: 0;
            color: white;
            text-align: center;
            font-weight: bold;
            padding-top: 0.25rem;
        }
    </style>
@endsection
@section('content')
    <div class="col-12 mb-5">
        <div class="row">
            <div class="container-xxl mx-auto p-sm-3 p-lg-4 mb-3">

                <div id="waitingArea" class="area">
                    <div class="py-4">
                        <h1 class="text-2xl">{{ __('Online Consultation') }}</h1>
                    </div>
                    <div class="container-xl d-flex flex-column gap-4 ">

                        <div
                            class="d-flex align-items-center justify-content-center w-100 rounded-3 border border-dark bg-dark ">
                            <video id='waitingAreaLocalVideo' class="h-24 bg-dark" autoplay muted></video>
                        </div>

                        <div class="d-flex gap-4 mb-3 justify-content-center">
                            <button id='waitingAreaToggleMicrophone' class="btn btn-primary">
                                <i class="uil-microphone"></i>
                            </button>

                            <button id='waitingAreaToggleCamera' class="btn btn-primary">
                                <i class="uil-video"></i>
                            </button>
                        </div>
                        <div class="d-flex flex-column gap-4 gap-x-2 text-muted">
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="username" class="col-3 col-form-label">Name:</label>
                                    <div class="col-9">
                                        <input class="form-control text-xs" id="username" type="text"
                                            placeholder="Name" />
                                    </div>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="cameraSelectBox" class="col-3 col-form-label">Camera:</label>
                                    <div class="col-9">
                                        <select class="form-select text-xs" id='cameraSelectBox'>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="microphoneSelectBox" class="col-3 col-form-label">Microphone:</label>
                                    <div class="col-9">
                                        <select class="form-select text-xs" id='microphoneSelectBox'>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <button id='joinMeetingBtn' class="btn btn-primary">
                                        Join Meeting
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id='meetingView' class="hidden d-flex w-100 h-100 gap-4 p-3">

                <div id="activeSpeakerContainer" class="bg-dark rounded-4 flex-fill position-relative">
                    <video id="activeSpeakerVideo" src="" autoplay class=" video"></video>
                    <div id="activeSpeakerUsername" class="hidden video_participante">

                    </div>
                </div>

                <div id="remoteParticipantContainer" class="d-flex flex-column gap-4">
                    <div id="localParticiapntContainer" class="rounded-4 bg-dark position-relative">
                        <video id="localVideoTag" src="" autoplay class="video"></video>
                        <div id="localUsername" class="video_participante">
                            {{ __('Me') }}
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2">
                    <button id='toggleMicrophone' class="btn btn-secondary mt-2">
                        <i class="uil-microphone"></i>
                    </button>

                    <button id='toggleCamera' class="btn btn-secondary mt-2">
                        <i class="uil-video"></i>
                    </button>

                    <button id='toggleScreen' class="btn btn-secondary mt-2">
                        <i class="uil-desktop-alt"></i>
                    </button>

                    <button id='leaveMeeting' class="btn btn-danger mt-2">
                        <i class="uil-exit"></i>
                    </button>

                </div>
            </div>

            <div id="leaveMeetingView" class="hidden">
                <h1 class="text-center fs-2 mt-5 fw-bold">
                    {{ __(' You have left the meeting') }}
                </h1>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let meetingJoined = false;
        const meeting = new Metered.Meeting();
        let cameraOn = false;
        let micOn = false;
        let screenSharingOn = false;
        let localVideoStream = null;
        let activeSpeakerId = null;
        let meetingInfo = {};

        async function initializeView() {
            /**
             * Populating the cameras
             */
            const videoInputDevices = await meeting.listVideoInputDevices();
            const videoOptions = [];
            for (let item of videoInputDevices) {
                videoOptions.push(
                    `<option value="${item.deviceId}">${item.label}</option>`
                )
            }
            $("#cameraSelectBox").html(videoOptions.join(""));

            /**
             * Populating Microphones
             */
            const audioInputDevices = await meeting.listAudioInputDevices();
            const audioOptions = [];
            for (let item of audioInputDevices) {
                audioOptions.push(
                    `<option value="${item.deviceId}">${item.label}</option>`
                )
            }
            $("#microphoneSelectBox").html(audioOptions.join(""));


            /**
             * Mute/Unmute Camera and Microphone
             */
            $("#waitingAreaToggleMicrophone").on("click", function() {
                if (micOn) {
                    micOn = false;
                    $("#waitingAreaToggleMicrophone").removeClass("bg-gray-500");
                    $("#waitingAreaToggleMicrophone").addClass("bg-gray-400");
                } else {
                    micOn = true;
                    $("#waitingAreaToggleMicrophone").removeClass("bg-gray-400");
                    $("#waitingAreaToggleMicrophone").addClass("bg-gray-500");
                }
            });

            $("#waitingAreaToggleCamera").on("click", async function() {
                if (cameraOn) {
                    cameraOn = false;
                    $("#waitingAreaToggleCamera").removeClass("bg-gray-500");
                    $("#waitingAreaToggleCamera").addClass("bg-gray-400");
                    const tracks = localVideoStream.getTracks();
                    tracks.forEach(function(track) {
                        track.stop();
                    });
                    localVideoStream = null;
                    $("#waitingAreaLocalVideo")[0].srcObject = null;
                } else {
                    cameraOn = true;
                    $("#waitingAreaToggleCamera").removeClass("bg-gray-400");
                    $("#waitingAreaToggleCamera").addClass("bg-gray-500");
                    localVideoStream = await meeting.getLocalVideoStream();
                    $("#waitingAreaLocalVideo")[0].srcObject = localVideoStream;
                    cameraOn = true;
                }
            });

            /**
             * Adding Event Handlers
             */
            $("#cameraSelectBox").on("change", async function() {
                const deviceId = $("#cameraSelectBox").val();
                await meeting.chooseVideoInputDevice(deviceId);
                if (cameraOn) {
                    localVideoStream = await meeting.getLocalVideoStream();
                    $("#waitingAreaLocalVideo")[0].srcObject = localVideoStream;
                }
            });

            $("#microphoneSelectBox").on("change", async function() {
                const deviceId = $("#microphoneSelectBox").val();
                await meeting.chooseAudioInputDevice(deviceId);
            });

        }
        initializeView();

        $("#joinMeetingBtn").on("click", async function() {
            var username = $("#username").val();
            if (!username) {
                return alert({{ __('Please enter a username') }});
            }

            try {
                meetingInfo = await meeting.join({
                    roomURL: `${window.METERED_DOMAIN}/${window.MEETING_ID}`,
                    name: username,
                });

                console.log("Meeting joined", meetingInfo);
                $("#waitingArea").addClass("hidden");
                $("#meetingView").removeClass("hidden");
                $("#meetingAreaUsername").text(username);

                /**
                 * If camera button is clicked on the meeting view
                 * then sharing the camera after joining the meeting.
                 */
                if (cameraOn) {
                    await meeting.startVideo();
                    $("#localVideoTag")[0].srcObject = localVideoStream;
                    $("#localVideoTag")[0].play();
                    $("#toggleCamera").removeClass("bg-gray-400");
                    $("#toggleCamera").addClass("bg-gray-500");
                }

                /**
                 * Microphone button is clicked on the meeting view then
                 * sharing the microphone after joining the meeting
                 */
                if (micOn) {
                    $("#toggleMicrophone").removeClass("bg-gray-400");
                    $("#toggleMicrophone").addClass("bg-gray-500");
                    await meeting.startAudio();
                }

            } catch (ex) {
                console.log("Error occurred when joining the meeting", ex);
            }
        });

        /**
         * Handling Events
         */
        meeting.on("onlineParticipants", function(participants) {

            for (let participantInfo of participants) {
                if (!$(`#participant-${participantInfo._id}`)[0] && participantInfo._id !== meeting.participantInfo
                    ._id) {
                    $("#remoteParticipantContainer").append(
                        `
          <div id="participant-${participantInfo._id}" class="w-48 h-48 rounded-3xl bg-gray-900 relative">
            <video id="video-${participantInfo._id}" src="" autoplay class="object-contain w-full rounded-t-3xl"></video>
            <video id="audio-${participantInfo._id}" src="" autoplay class="hidden"></video>
            <div class="absolute h-8 w-full bg-gray-700 rounded-b-3xl bottom-0 text-white text-center font-bold pt-1">
                ${participantInfo.name}
            </div>
          </div>
          `
                    );
                }
            }
        });

        meeting.on("participantLeft", function(participantInfo) {
            $("#participant-" + participantInfo._id).remove();
            if (participantInfo._id === activeSpeakerId) {
                $("#activeSpeakerUsername").text("");
                $("#activeSpeakerUsername").addClass("hidden");
            }
        });

        meeting.on("remoteTrackStarted", function(remoteTrackItem) {
            $("#activeSpeakerUsername").removeClass("hidden");

            if (remoteTrackItem.type === "video") {
                let mediaStream = new MediaStream();
                mediaStream.addTrack(remoteTrackItem.track);
                if ($("#video-" + remoteTrackItem.participantSessionId)[0]) {
                    $("#video-" + remoteTrackItem.participantSessionId)[0].srcObject = mediaStream;
                    $("#video-" + remoteTrackItem.participantSessionId)[0].play();
                }
            }

            if (remoteTrackItem.type === "audio") {
                let mediaStream = new MediaStream();
                mediaStream.addTrack(remoteTrackItem.track);
                if ($("#video-" + remoteTrackItem.participantSessionId)[0]) {
                    $("#audio-" + remoteTrackItem.participantSessionId)[0].srcObject = mediaStream;
                    $("#audio-" + remoteTrackItem.participantSessionId)[0].play();
                }
            }
            setActiveSpeaker(remoteTrackItem);
        });

        meeting.on("remoteTrackStopped", function(remoteTrackItem) {
            if (remoteTrackItem.type === "video") {
                if ($("#video-" + remoteTrackItem.participantSessionId)[0]) {
                    $("#video-" + remoteTrackItem.participantSessionId)[0].srcObject = null;
                    $("#video-" + remoteTrackItem.participantSessionId)[0].pause();
                }

                if (remoteTrackItem.participantSessionId === activeSpeakerId) {
                    $("#activeSpeakerVideo")[0].srcObject = null;
                    $("#activeSpeakerVideo")[0].pause();
                }
            }

            if (remoteTrackItem.type === "audio") {
                if ($("#audio-" + remoteTrackItem.participantSessionId)[0]) {
                    $("#audio-" + remoteTrackItem.participantSessionId)[0].srcObject = null;
                    $("#audio-" + remoteTrackItem.participantSessionId)[0].pause();
                }
            }
        });


        meeting.on("activeSpeaker", function(activeSpeaker) {
            setActiveSpeaker(activeSpeaker);
        });

        function setActiveSpeaker(activeSpeaker) {

            if (activeSpeakerId != activeSpeaker.participantSessionId) {
                $(`#participant-${activeSpeakerId}`).show();
            }

            activeSpeakerId = activeSpeaker.participantSessionId;
            $(`#participant-${activeSpeakerId}`).hide();

            $("#activeSpeakerUsername").text(activeSpeaker.name || activeSpeaker.participant.name);

            if ($(`#video-${activeSpeaker.participantSessionId}`)[0]) {
                let stream = $(
                    `#video-${activeSpeaker.participantSessionId}`
                )[0].srcObject;
                $("#activeSpeakerVideo")[0].srcObject = stream.clone();
            }

            if (activeSpeaker.participantSessionId === meeting.participantSessionId) {
                let stream = $(`#localVideoTag`)[0].srcObject;
                if (stream) {
                    $("#localVideoTag")[0].srcObject = stream.clone();
                }
            }
        }

        $("#toggleMicrophone").on("click", async function() {
            if (micOn) {
                $("#toggleMicrophone").removeClass("bg-gray-500");
                $("#toggleMicrophone").addClass("bg-gray-400");
                micOn = false;
                await meeting.stopAudio();
            } else {
                $("#toggleMicrophone").removeClass("bg-gray-400");
                $("#toggleMicrophone").addClass("bg-gray-500");
                micOn = true;
                await meeting.startAudio();
            }
        });


        $("#toggleCamera").on("click", async function() {
            if (cameraOn) {
                $("#toggleCamera").removeClass("bg-gray-500");
                $("#toggleCamera").addClass("bg-gray-400");
                $("#toggleScreen").removeClass("bg-gray-500");
                $("#toggleScreen").addClass("bg-gray-400");
                cameraOn = false;
                await meeting.stopVideo();
                const tracks = localVideoStream.getTracks();
                tracks.forEach(function(track) {
                    track.stop();
                });
                localVideoStream = null;
                $("#localVideoTag")[0].srcObject = null;
            } else {
                $("#toggleCamera").removeClass("bg-gray-400");
                $("#toggleCamera").addClass("bg-gray-500");
                cameraOn = true;
                await meeting.startVideo();
                localVideoStream = await meeting.getLocalVideoStream();
                $("#localVideoTag")[0].srcObject = localVideoStream;
            }
        });


        $("#toggleScreen").on("click", async function() {
            if (screenSharingOn) {
                $("#toggleScreen").removeClass("bg-gray-500");
                $("#toggleScreen").addClass("bg-gray-400");
                screenSharingOn = false;
                await meeting.stopVideo();
                const tracks = localVideoStream.getTracks();
                tracks.forEach(function(track) {
                    track.stop();
                });
                localVideoStream = null;
                $("#localVideoTag")[0].srcObject = null;

            } else {
                $("#toggleScreen").removeClass("bg-gray-400");
                $("#toggleScreen").addClass("bg-gray-500");
                $("#toggleCamera").removeClass("bg-gray-500");
                $("#toggleCamera").addClass("bg-gray-400");
                screenSharingOn = true;
                localVideoStream = await meeting.startScreenShare();
                $("#localVideoTag")[0].srcObject = localVideoStream;
            }
        });


        $("#leaveMeeting").on("click", async function() {
            await meeting.leaveMeeting();
            $("#meetingView").addClass("hidden");
            $("#leaveMeetingView").removeClass("hidden");
        });
    </script>
@endsection
