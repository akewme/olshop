@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
        <div class="col-md-12 pb-4 mt-lg-4">
            <button class="btn btn-info btn-md px-4 mx-4  mb-4 btn-topleft"  data-toggle="modal" href="#tambahproduk" >
                <i class="fa fa-edit"></i> Buat Jasa
            </button>
            <div class="col-md-10 float-right">
                <div class="row">
                    @if(Auth::user()->role == 1)
                    <div class="col-md-4 px-4 pb-4">
                        <select class="form-control" id="tokoId">
                            <option  selected value="">Semua User</option>
                            @foreach (App\User::all()->sortBy("name") as $u)
                                <option value="{{$u->id}}">{{$u->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div class="col-md-4 px-4 pb-4">
                    </div>
                    @endif
                    <div class="col-md-4 px-4 pb-4">
                        <select class="form-control" id="urutkan">
                            <option selected value="terbaru">Terbaru</option>
                            {{-- <option value="terlaris">Terlaris</option> --}}
                            <option value="termurah">Termurah</option>
                            <option value="termahal">Termahal</option>
                        </select>
                    </div>
                    <div class="col-md-4 px-4 pb-4">
                        <input class="form-control" id="searchData" type="text" placeholder="Cari">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal " id="tambahproduk" >
            <div class="modal-dialog animated bounceInDown">
                <div class="modal-content btn-circle" style="position:fixed:width:100%">
                    <form action="" method="POST" id="formTambahProduk" class="modal-body">
                        <div class="form-group">
                            <label> <b> Buat Jasa </b> </label>
                            <button class="btn btn-secondary btn-sm float-right btn-circle" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="form-group">
                            <label> Nama Jasa</label>
                            <input class="form-control" id="nama" type="text" placeholder="Nama Jasa">
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="img">
                            <div class="row" id="upload-form">
                                <div class="col-md-12 text-center">
                                    <input class="btn btn-info btn-md btn-topleft mb-4" type="file" id="image_file" >
                                    <div id="upload-demo"></div>
                                </div>
                                <div class="col-md-12" >
                                    <button class="btn btn-info btn-block upload-image btn-circle">Lanjutkan</button>
                                </div>
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <div id="preview-crop-image"></div>
                            </div>
                        </div>
                        <div id="form-lanjutan">
                            <div class="form-group">
                                <label> Harga </label>
                                <input class="form-control" id="harga" type="number" placeholder="Rp">
                            </div>
                            <div class="form-group">
                                {{-- <label> Stok </label> --}}
                                <input class="form-control" id="stok" type="hidden" value="1" placeholder="Jumlah">
                            </div>
                            <div class="form-group">
                                {{-- <label> Berat </label> --}}
                                <input class="form-control" id="berat" type="hidden" value="1" placeholder="/Kg">
                            </div>
                            <div class="form-group">
                                <label> Deskripsi </label>
                                <textarea class="form-control" id="deskripsi"></textarea>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-success" >Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            {{-- List Produk --}}
            <div class="row pr-2 animated slideInLeft" id="listproduk"></div>
            {{-- Lebih Banyak --}}
            <div class="text-center py-4 mb-4">
                <input type="hidden" id="loadMore" value="1">
                <div id="btn-lebih-banyak"></div>
            </div>
        </div>
    </div>
   </div>
</div>


<div id="modalDetail"></div>

@section('js-after')
    {{-- Upload Gambar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script>
    <script>

    $("#form-lanjutan").hide();
        var resize = $('#upload-demo').croppie({
        enableExif: true,
        enableOrientation: true,    
        viewport: { // Default { width: 100, height: 100, type: 'square' } 
            width: 300,
            height: 300,
            type: 'square' // circle
        },
        boundary: {
            width: 300,
            height: 300
        }
    });
    $('#image_file').on('change', function () { 
    var reader = new FileReader();
        reader.onload = function (e) {
        resize.croppie('bind',{
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
        }
        reader.readAsDataURL(this.files[0]);
    });
    $('.upload-image').on('click', function (ev) {
    resize.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (img) {
        html = '<img src="' + img + '" />';
        $("#preview-crop-image").html(html);
        $("#upload-success").html("Images cropped and uploaded successfully.");
        $("#upload-success").show();

            // $.ajax({
            //     url: "/upload-image",
            //     type: "POST",
            //     data: {"image":img},
            //     success: function (data) {
            //         console.log(data);
            //         $("#img").val(data);
            //         $("#upload-form").hide();
            //         $("#form-lanjutan").show();
            //     }
            // });
            
            $.post("/upload-image", {"image":img})
                .done((res) => {
                    console.log(res);
                    $("#img").val(res);
                    $("#upload-form").hide();
                    $("#form-lanjutan").show();
                });

        });
    });

    // Ambil Produk
    function ambilProduk(page){
        let toko = $("#tokoId").val();
        let urutkan = $("#urutkan").val();
        let search = $("#searchData").val();

        $.get("/web/produk?page="+page,{
            search: search,
            urutkan: urutkan,
            toko: toko
        })
        .done((res) => {
            $("#loadMore").val(page+1);
            let d = res.data;
            let data = '';
            for (let i = 0; i < d.length; i++) {
                let data1 = JSON.stringify(d[i]);
                data += `<div class="col-md-6 col-lg-4 my-2 ">
                            <div class="row ml-1 produk">
                                <div class="col-5 pl-0 pb-0">
                                    <img  src="/img/${d[i].img}" class="card-img-top btn-circle" alt="...">
                                </div>
                                <div class="col-7">
                                    <a class="nav-link p-0" href="#">
                                        <h5 class="pt-2">
                                            ${d[i].nama}
                                        </h5>
                                    </a>
                                    <h6>
                                        <a class="nav-link p-0" href="#">@${d[i].username}</a>
                                    </h6>
                                    <span>Rp. ${d[i].harga} </span>

                                    <button onclick='lihatDetail(${data1})' class="btn btn-info btn-sm float-right btn-edit btn-circle m-2"><i class="fa fa-edit "></i> Edit</button>
                                </div>
                            </div>
                        </div>`;
            }

            if(res.total > 9 && res.last_page != page){
                $("#btn-lebih-banyak").html(`<button class="btn btn-secondary btn-sm btn-topleft" onclick="loadMore()"><i class="fa fa-arrow-right"></i> Lebih Banyak</button>`);
            }else{
                $("#btn-lebih-banyak").html("");
            }
            if(page > 1){
                $("#listproduk").append(data);
            }else{
                $("#listproduk").html(data);
            }

            
        })
    }
    ambilProduk(1);


    function lihatDetail(d){
        // console.log(data);
        let modalDetail = `<div class="modal animated bounceInUp" id="modalD">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content p-lg-4 btn-circle">
                                        <div class="col-md-12">
                                            <div class="row animated zoomIn faster">
                                                <div class="col-md-12 col-lg-5 px-0 pb-0">
                                                    <img src="/img/${d.img}" class="card-img-top btn-circle" alt="...">
                                                </div>
                                                <div class="col-md-12 col-lg-7">
                                                    <button data-dismiss="modal" class="btn btn-secondary btn-sm float-right btn-edit btn-circle m-2"><i class="fa fa-close"></i></button>
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input id="nama-edit" type="text" value="${d.nama}" class="form-control  btn-topleft" >
                                                    </div>
                                                    <div class="form-group">
                                                            <label>Harga</label>
                                                            <input id="harga-edit" type="text" value="${d.harga}" class="form-control  btn-topleft" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deskripsi</label>
                                                        <textarea id="deskripsi-edit" class="form-control  btn-topleft">${d.deskripsi}</textarea>
                                                    </div>

                                                </div>
                                                <div class="col-md-12">
                                                        
                                                        <button id="editProduk" class="btn btn-info float-right btn-edit btn-circle m-2"><i class="fa fa-edit "></i> Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </div>`;
        $("#modalDetail").html(modalDetail);
        $("#modalD").modal("show");

        // Edit Produk
        $("#editProduk").click(function(e){
            e.preventDefault();

            let data = {
                nama : $("#nama-edit").val(),
                img : $("#img-edit").val(),
                harga : $("#harga-edit").val(),
                status : $("#status-edit").val(),
                deskripsi : $("#deskripsi-edit").val()
            }

            $.post("/web/produk/edit/"+d.id, data)
                .done((res) => {
                    if(res.id){
                        alert("success");
                        console.log(res);
                        $("#nama-edit").val("");
                        $("#img-edit").val("");
                        $("#harga-edit").val("");
                        $("#status-edit").val("");
                        $("#deskripsi-edit").val("");

                        ambilProduk(1);
                    
                        $("#modalD").modal("hide");

                    }else{
                        console.log(res);
                    }
                })
        })
        
    }
    function loadMore(){
        let page  = $("#loadMore").val();
        ambilProduk(page);
    }

    // Urutkan

    

    $('#searchData').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            ambilProduk(1);
        }
    });


    $('#urutkan').select2({
        theme: "bootstrap"
    });

    $('#urutkan').on('select2:select', function (e) {
        ambilProduk(1);
    });

    $('#tokoId').select2({
        theme: "bootstrap"
    });

    $('#tokoId').on('select2:select', function (e) {
        ambilProduk(1);
    });


    // Tambah Produk
    $("#formTambahProduk").submit(function(e){
        e.preventDefault();

        let data = {
            nama : $("#nama").val(),
            img : $("#img").val(),
            harga : $("#harga").val(),
            stok : $("#stok").val(),
            berat : $("#berat").val(),
            deskripsi : $("#deskripsi").val()
        };

        $.post("/web/produk/tambah",data)
            .done((res) => {
                if(res.id){
                    alert("success");
                    console.log(res);
                    $("#nama").val("");
                    $("#img").val("");
                    $("#harga").val("");
                    $("#stok").val("");
                    $("#berat").val("");
                    $("#deskripsi").val("");
                    $("#tambahproduk").modal("hide");

                    ambilProduk(1);
                    $("#upload-form").show();
                    $("#form-lanjutan").hide();
                    $("#image_file").val("");
                    $("#preview-crop-image").html("");

                }else{
                    console.log(res);
                }
            })
    })

    </script>
@endsection

@endsection

