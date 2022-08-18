@extends('auth.main')

@section('content')
<div class="row">
    <div class="col">
    @if(session()->has('success'))  
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{ session()->get('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Daftar Pengajuan Produk Hukum</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                    <thead>
                        <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Jenis / Bentuk Peraturan</th>
                        <th scope="col">Judul Produk Hukum</th>
                        <th scope="col">Tanggal Pengajuan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($kasubag_undangs as $draft)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$draft->staffUndang->admin->draft->jenis}}</td>
                        <td>{{$draft->staffUndang->admin->draft->judul}}</td>
                        <td>{{date('d-m-Y', strtotime($draft->staffUndang->admin->draft->tanggal_pengajuan))}}</td>
                        <td>{{$draft->status}}</td>
                        <td>
                            <div class="mx-auto">
                                <button type="button" class="badge bg-warning border-0" data-bs-toggle="modal" data-bs-target="#trayek{{$draft->id}}">
                                    trayek
                                </button>

                            <!-- Modal Trayek -->
                            <div class="modal fade " id="trayek{{$draft->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Trayek</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-1 fs-6">
                                            1. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Operator SKPD 
                                                <div class="fs-7">
                                                    Diajukan pada {{date('d-m-Y', strtotime($draft->staffUndang->admin->draft->tanggal_pengajuan))}} pukul {{date('H:i', strtotime($draft->staffUndang->admin->draft->created_at))}} oleh {{$draft->staffUndang->admin->draft->user->name}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            2. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Admin FO 
                                                <div class="fs-7">
                                                    @if($draft->staffUndang->admin->status == 'menunggu')
                                                    {{$draft->staffUndang->admin->status}} pada {{date('d-m-Y', strtotime($draft->staffUndang->admin->updated_at))}} pukul {{date('H:i', strtotime($draft->staffUndang->admin->updated_at))}}
                                                    @else
                                                    {{$draft->staffUndang->admin->status}} pada {{date('d-m-Y', strtotime($draft->staffUndang->admin->updated_at))}} pukul {{date('H:i', strtotime($draft->staffUndang->admin->updated_at))}} oleh {{$draft->staffUndang->admin->validated}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            3. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Staff perundang undangan 
                                                <div class="fs-7">
                                                    @if($draft->staffUndang->status == 'menunggu')
                                                    {{$draft->staffUndang->status}} pada {{date('d-m-Y', strtotime($draft->staffUndang->updated_at))}} pukul {{date('H:i', strtotime($draft->staffUndang->updated_at))}}
                                                    @else
                                                    {{$draft->staffUndang->status}} pada {{date('d-m-Y', strtotime($draft->staffUndang->updated_at))}} pukul {{date('H:i', strtotime($draft->staffUndang->updated_at))}} oleh {{$draft->staffUndang->validated}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            4. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Kasubag perundang undangan 
                                                <div class="fs-7">
                                                    @if($draft->status == 'menunggu' || $draft->status == 'ditolak oleh kabag')
                                                    {{$draft->status}} pada {{date('d-m-Y', strtotime($draft->updated_at))}} pukul {{date('H:i', strtotime($draft->updated_at))}}
                                                    @else
                                                    {{$draft->status}} pada {{date('d-m-Y', strtotime($draft->updated_at))}} pukul {{date('H:i', strtotime($draft->updated_at))}} oleh {{$draft->validated}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            5. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Kabag
                                                <div class="fs-7">
                                                    @if(isset($draft->kabag->status))
                                                        @if($draft->kabag->status == 'menunggu' || $draft->kabag->status == 'ditolak oleh sekda' || $draft->kabag->status == 'ditolak oleh walikota')
                                                        {{$draft->kabag->status}} pada {{date('d-m-Y', strtotime($draft->kabag->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->updated_at))}}
                                                        @else
                                                        {{$draft->kabag->status}} pada {{date('d-m-Y', strtotime($draft->kabag->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->updated_at))}} oleh {{$draft->kabag->validated}}
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            6. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Kepala Dinas
                                                <div class="fs-7">
                                                    @if(isset($draft->kabag->kepalaDinas->status))
                                                        @if($draft->kabag->kepalaDinas->status == 'menunggu' || $draft->kabag->kepalaDinas->status == 'ditolak oleh sekda')
                                                        {{$draft->kabag->kepalaDinas->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->updated_at))}}
                                                        @else
                                                        {{$draft->kabag->kepalaDinas->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->updated_at))}} oleh {{$draft->kabag->kepalaDinas->validated}}
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            7. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Sekda
                                                <div class="fs-7">
                                                    @if(isset($draft->kabag->kepalaDinas->sekda->status))
                                                        @if($draft->kabag->kepalaDinas->sekda->status == 'menunggu' || $draft->kabag->kepalaDinas->sekda->status == 'ditolak oleh walikota')
                                                        {{$draft->kabag->kepalaDinas->sekda->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->sekda->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->sekda->updated_at))}}
                                                        @else
                                                        {{$draft->kabag->kepalaDinas->sekda->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->sekda->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->sekda->updated_at))}} oleh {{$draft->kabag->kepalaDinas->sekda->validated}}
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            8. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Walikota
                                                <div class="fs-7">
                                                    @if(isset($draft->kabag->kepalaDinas->sekda->walikota->status))
                                                        @if($draft->kabag->kepalaDinas->sekda->walikota->status == 'menunggu')
                                                        {{$draft->kabag->kepalaDinas->sekda->walikota->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->sekda->walikota->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->sekda->walikota->updated_at))}}
                                                        @else
                                                        {{$draft->kabag->kepalaDinas->sekda->walikota->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->sekda->walikota->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->sekda->walikota->updated_at))}} oleh {{$draft->kabag->kepalaDinas->sekda->walikota->validated}}
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            9. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Staff Dokumentasi
                                                <div class="fs-7">
                                                    @if(isset($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                                        @if($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'menunggu')
                                                        {{$draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                                        @else
                                                        {{$draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}} oleh {{$draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->validated}}
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            10. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Kasubag Dokumentasi
                                                <div class="fs-7">
                                                    @if(isset($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                                        @if($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'menunggu')
                                                        {{$draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}
                                                        @else
                                                        {{$draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status}} pada {{date('d-m-Y', strtotime($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}} pukul {{date('H:i', strtotime($draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}} oleh {{$draft->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->validated}}
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>

                                @if($draft->status == 'menunggu' || $draft->status == 'ditolak oleh kabag')
                                <a href="/dashboard/kasubagu/readprodukhukum/{{$draft->id}}" class="badge bg-info border-0 text-decoration-none">edit</a>
                                @endif

                                @if($draft->status == 'diterima' || $draft->status == 'ditolak')
                                    <a href="/dashboard/kasubagu/readprodukhukum/{{$draft->id}}" class="badge bg-primary border-0 text-decoration-none">lihat</a>
                                @endif
                            </div>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection