@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Buat Kriteria</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li>
                        <span>Dashboard </span><span>| </span>  
                    </li>
                    <li>
                        <a href="{{ route('dashboard.topsis.kriteria') }}"><span class="text-black">  Buat Kriteria </span></a><span> |</span>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('dashboard.topsis.alternatif') }}"><span class="badge bg-success"> Buat Alternatif</span></a><span> |</span>
                    </li>
                    <li>
                        <a href="#" class="text-black"> Hasil </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('container')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Halaman membuat Data Alternatif</h4>
                <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to
                    each
                    textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                <div class="row" style="float: right">
                    <div>
                        <button type="button" class="btn btn-primary waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target="#exampleModalkriteria" data-bs-whatever="@mdo"><i
                                class="bx bx-plus-medical label-icon"></i> alternatif</button>
                        <div class="modal fade" id="exampleModalkriteria" tabindex="-1" aria-labelledby="exampleModalLabelkriteria"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabelkriteria">New message</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" method="POST">
                                            <div class="mb-3">
                                                <label for="kode" class="col-form-label">Jenis Pertemuan:</label>
                                                <input type="text" class="form-control" id="kode">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br><br><br>
                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="1">
                                <td data-field="id" style="width: 80px">1</td>
                                <td data-field="name">David McHenry</td>
                                <td data-field="age">24</td>
                                <td data-field="gender">Male</td>
                                <td style="width: 100px">
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr data-id="2">
                                <td data-field="id">2</td>
                                <td data-field="name">Frank Kirk</td>
                                <td data-field="age">22</td>
                                <td data-field="gender">Male</td>
                                <td>
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr data-id="3">
                                <td data-field="id">3</td>
                                <td data-field="name">Rafael Morales</td>
                                <td data-field="age">26</td>
                                <td data-field="gender">Male</td>
                                <td>
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr data-id="4">
                                <td data-field="id">4</td>
                                <td data-field="name">Mark Ellison</td>
                                <td data-field="age">32</td>
                                <td data-field="gender">Male</td>
                                <td>
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr data-id="5">
                                <td data-field="id">5</td>
                                <td data-field="name">Minnie Walter</td>
                                <td data-field="age">27</td>
                                <td data-field="gender">Female</td>
                                <td>
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
