@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
        <div class="col-md-12 pb-4 mt-lg-4">
            <button class="btn btn-primary btn-md px-4 mb-4 btn-topleft"  data-toggle="modal" href="#tambahproduk" >
                <i class="fa fa-edit"></i> Tambah
            </button>
            <div class="float-right col-md-10 float-right">
                <div class="row ">
                    <div class="col-md-6 mb-4">
                        <select class="form-control" name="" id="urutkan">
                            <option value="">Urutkan</option>
                            <option value="terbaru">Terbaru</option>
                            <option value="terlaris">Terlaris</option>
                            <option value="terlaris">Termurah</option>
                            <option value="terlaris">Termahal</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" placeholder="Cari">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal " id="tambahproduk" >
            <div class="modal-dialog">
                <div class="modal-content" style="position:fixed:width:100%">
                    <form action="" method="POST" id="formTambahProduk" class="modal-body">
                        <div class="form-group">
                            <label> <b>Tambah Produk</b> </label>
                            <button class="btn btn-secondary float-right" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="form-group">
                            <label> Nama</label>
                            <input class="form-control" id="nama" type="text" placeholder="Nama Produk">
                        </div>
                        <div class="form-group">
                            <label> Img </label>
                            <input type="hidden" id="img">
                            <div class="row" id="upload-form">
                                <div class="col-md-12 text-center">
                                    <input class="btn btn-primary btn-md btn-topleft mb-4" type="file" id="image_file" >
                                    <div id="upload-demo"></div>
                                </div>
                                <div class="col-md-12" >
                                    <button class="btn btn-primary btn-block upload-image btn-circle">Lanjutkan</button>
                                </div>
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <div id="preview-crop-image"></div>
                            </div>
                            <input type="hidden" id="img">
                        </div>
                        <div id="form-lanjutan">
                            <div class="form-group">
                                <label> Harga </label>
                                <input class="form-control" id="harga" type="number" placeholder="Rp">
                            </div>
                            <div class="form-group">
                                <label> Stok </label>
                                <input class="form-control" id="stok" type="number" placeholder="Jumlah">
                            </div>
                            <div class="form-group">
                                <label> Berat </label>
                                <input class="form-control" id="berat" type="number" placeholder="/Kg">
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
            <div class="row" id="listproduk"></div>
            <div class="text-center py-4">
                <input type="hidden" id="loadMore" value="1">
                <button class="btn btn-secondary btn-sm" onclick="loadMore()"><i class="fa fa-arrow-right"></i> Lebih Banyak</button>
            </div>
        </div>
    </div>
   </div>
</div>

@section('css-after')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.css">   

    <style>
    .produk{
        color: black;
        transition: .2s;
        border-radius: 20px;
        background: #fff;
    }
    .produk img{
        cursor: pointer;
    }
    .produk:hover{
        background: #007bff;
        color: white;
        animation: bounce 1s
    }
    .btn-circle{
        border-radius: 30px;
    }
    .btn-topleft{
        border-radius: 30px;
        border-top-left-radius: 0px;
    }
    .produk:hover .btn-edit{
        animation: zoomIn 1s;
        transform: translateY(-15px);
        transform: rotate(180deg);
        transition: 1s;
    }
    </style>
@endsection

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

            $.ajax({
                url: "/upload-image",
                type: "POST",
                data: {"image":img},
                success: function (data) {
                    console.log(data);
                    $("#img").val(data);
                    $("#upload-form").hide();
                    $("#form-lanjutan").show();
                }
            });

        });
    });

    // Ambil Produk
    function ambilProduk(page){
        $.get("/web/produk?page="+page)
        .done((res) => {
            $("#loadMore").val(page+1);
            let d = res.data;
            let data = '';
            for (let i = 0; i < d.length; i++) {
                data += `<div class="col-md-6 col-lg-4 my-2 ">
                            <div class="row ml-1 shadow-sm produk">
                                <div class="col-5 pl-0 pb-0">
                                    <img src="/img/${d[i].img}" class="card-img-top" alt="...">
                                </div>
                                <div class="col-7">
                                    <h5 class="pt-2">${d[i].nama}</h5>
                                    <b>Rp. ${d[i].harga} </b>
                                    <br>
                                    <i>Stok : ${d[i].stok}</i>
                                    <button class="btn btn-secondary btn-sm float-right btn-edit btn-circle"><i class="fa fa-edit "></i></button>
                                </div>
                            </div>
                        </div>`;
            }

            if(page > 1){
                $("#listproduk").append(data);
            }else{
                $("#listproduk").html(data);
            }
            
        })
    }
    ambilProduk(1);

    function loadMore(){
        let page  = $("#loadMore").val();
        ambilProduk(page);
    }

    // Urutkan

    $("#urutkan").change(function() {
        let data = $(this).val();
        alert(data);
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
                }else{
                    console.log(res);
                }
            })
    })
    </script>
@endsection

@endsection

