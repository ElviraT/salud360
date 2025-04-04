<div class="col-12">
    <div class="row">
        <div class="col-12 mb-2" align="right">
            {{-- @can('files.upload') --}}
            <a class="btn btn-info btn-sm" href="#" data-bs-toggle="modal" data-bs-record-id="{{ $patient->id }}"
                data-bs-target="#folder_file"><i class="uil-plus-circle"></i>&nbsp;@lang('Upload File')</a>
            {{-- @endcan --}}
        </div>
        <div class="table-responsive">
            <table id="file" class="table dt-responsive nowrap w-100">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">{{ 'Nro' }}</th>
                        <th scope="col" colspan="2">@lang('Name')</th>
                        <th scope="col">@lang('Created on')</th>
                        <th scope="col">@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $key => $file)
                        @php
                            $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img src="{{ getFileIcon($extension) }}" alt="{{ $extension }} file icon"
                                    width="25px">
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#visor_imagen"
                                    data-bs-record-title="{{ $file->name }}"
                                    data-bs-record-extension="{{ $extension }}"
                                    data-bs-record-img="{{ asset('storage/' . $file->name) }}" style="color: black">
                                    {{ $file->name }}
                                </a>
                            </td>
                            <td>{{ $file->created_at->format('d M Y, h:i A') }}</td>
                            <td class="table-actions">
                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirm-delete"
                                    data-bs-record-id="{{ $file->id }}"
                                    data-bs-record-title="{{ 'el archivo ' . $file->name }}"
                                    data-bs-action="{{ route('files.destroy', $file) }}"
                                    title="{{ __('Delete File') }}">
                                    <i class="uil-trash-alt"></i>@lang('Delete')
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @php
            function getFileIcon($extension)
            {
                $icons = [
                    'jpg' => asset('assets/images/icons/icono_imagen.png'),
                    'png' => asset('assets/images/icons/icono_imagen.png'),
                    'jpeg' => asset('assets/images/icons/icono_imagen.png'),
                    'pdf' => asset('assets/images/icons/icono_pdf.jpg'),
                    'docx' => asset('assets/images/icons/icono_word.png'),
                    'pptx' => asset('assets/images/icons/icono_pp.png'),
                    'xlsx' => asset('assets/images/icons/icono_xls.png'),
                ];
                return $icons[$extension] ?? ''; // Retorna la ruta del icono o una cadena vacía si no se encuentra
            }
        @endphp
    </div>
</div>
