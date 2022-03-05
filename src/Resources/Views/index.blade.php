@extends('main')


@section('content')
    <div class="container mt-5">
        <div id="page"></div>
        <!-- Button trigger modal -->
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-success m-4" data-bs-toggle="modal" data-bs-target="#toolsModal">+</button>
            </div>
            <div>
                <button onclick="store()" type="button" class="btn btn-success m-4">
                    Save
                    <i class="mdi mdi-content-save"></i>
                </button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="toolsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="d-flex justify-content-center">
                                <div style="cursor: pointer;" onclick="openAlbumDialog()" class="text-center mx-4 shadow-sm p-4 mb-5 bg-white rounded">
                                    <i class="display-2 mdi mdi-image" style="color: #880E4F"></i>
                                    <div>
                                        <span>عکس</span>
                                    </div>
                                </div>

                                <div style="cursor: pointer;" data-bs-dismiss="modal" onclick="addTitle()" class="text-center mx-4 shadow-sm p-4 mb-5 bg-white rounded">
                                    <i class="display-2 mdi mdi-format-title" style="color: #004D40"></i>
                                    <div>
                                        <span>عنوان</span>
                                    </div>
                                </div>

                                <div style="cursor: pointer;" data-bs-dismiss="modal" onclick="addTextarea()" class="text-center mx-4 shadow-sm p-4 mb-5 bg-white rounded">
                                    <i class="display-2 mdi mdi-text-long" style="color: #7B1FA2"></i>
                                    <div>
                                        <span>متن</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div style="cursor: pointer;" data-bs-dismiss="modal" onclick="addList()" class="text-center mx-4 shadow-sm p-4 mb-5 bg-white rounded">
                                    <i class="display-2 mdi mdi-format-list-bulleted-square" style="color: #F9A825"></i>
                                    <div>
                                        <span>لیست</span>
                                    </div>
                                </div>

                                <div style="cursor: pointer;" data-bs-dismiss="modal" onclick="openAlbumDialog('for-slider')" class="text-center mx-4 shadow-sm p-4 mb-5 bg-white rounded">
                                    <i class="display-2 mdi mdi-image-multiple" style="color: #311B92"></i>
                                    <div>
                                        <span>گالری</span>
                                    </div>
                                </div>

                                <div style="cursor: pointer;" data-bs-dismiss="modal" onclick="addVideo()" class="text-center mx-4 shadow-sm p-4 mb-5 bg-white rounded">
                                    <i class="display-2 mdi mdi-video" style="color: #B71C1C"></i>
                                    <div>
                                        <span>چند رسانه‌ای</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="albumModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 row mx-0">
                            <div class="col-md-10 row mx-0 content">

                            </div>
                            <div class="col-md-2">
                                <div class="">

                                    <form id="formAddImage">
                                        <input type="file" name="image" id="selected-image-file" hidden >
                                        <span class="btn btn-warning w-100 text-center" onclick="$('#formAddImage #selected-image-file').click()">Upload</span>
                                        <span onclick="upload('formAddImage','/image/store',null)" class="btn btn-success w-100 btn-sm py-0">submit</span>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="albumModalForSlider" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content modal-lg">
                    <div class="modal-header"><span class="btn btn-light" onclick="window.pathes=[];$('.content img').css('border','none')">Deselect All</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 row mx-0">
                            <div class="col-md-10 row mx-0 content">

                            </div>
                            <div class="col-md-2">
                                <div class="">

                                    <form id="formAddImageSlider">
                                        <input type="file" name="image" id="selected-image-file" hidden onchange="$(this).next().text('Click on submit to add to the list')" >
                                        <span class="btn btn-warning w-100 text-center" onclick="$('#formAddImageSlider #selected-image-file').click()">Upload</span>
                                        <div class="small text-muted"></div>
                                        <span onclick="upload('formAddImageSlider','/image/store','for-slider')" class="btn btn-success w-100 btn-sm py-0">submit</span>
                                    </form>

                                </div>
                            </div>
                            <div class="save-and-exit col-12 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        function addTextarea(){
            var div = document.getElementById('page');
            $(div).append(`<div class="d-flex"><textarea data-type="text" class="form-control my-2 myElm"></textarea><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);
        }

        function addTitle(){
            var div = document.getElementById('page');
            $(div).append(`<div class="d-flex"><input type="text" data-type="title" class="form-control my-2 myElm"><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);
        }

        {{--function addImage(){--}}
        {{--    var div = document.getElementById('page');--}}
        {{--    var number = new Date().getTime();--}}
        {{--    $(div).append(`<div class="d-flex"><div><form id="form-${number}" enctype="multipart/form-data"><input type="file" name="image" data-type="image" onchange="previewImage(event, 'preview-image-'+${number})" class="form-control my-2 myElm"></form>` +--}}
        {{--        `<div class="text-center"><img id="preview-image-${number}" class="d-none" src="" width="144" height="81"></div><span onclick="upload('form-'+${number}, 'http://{{ $_SERVER['HTTP_HOST'] }}/image-upload')" class="btn btn-warning">Upload</span></div><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);--}}
        {{--}--}}
        function addImage(path){
            var div = document.getElementById('page');
            var number = new Date().getTime();
            $(div).append(`<div class="d-flex"><div><input type="hidden" value='${path}' name="image" data-type="image" class="form-control my-2 myElm">` +
                `<div class="text-center"><img src='${path}' width="144" height="81"></div></div><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);
            $('#albumModal').modal('hide');
        }

        function addVideo(){
            var div = document.getElementById('page');
            var number = new Date().getTime();
            $(div).append(`<div class="d-flex"><input type="text" data-type="video" class="form-control my-2 myElm"><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);
         }

        // function addGallery(){
        //     var div = document.getElementById('page');
        //     var number = new Date().getTime();
        //     $(div).append(`<div class="d-flex"><div><input type="text" name="album[]" data-type="album" class="form-control my-2 myElm">` +
        //         `<div class="text-center"><img id="preview-image-${number}" class="d-none" src="" width="144" height="81"></div></div><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);
        // }
        function addGallery(pathes){
            var div = document.getElementById('page');
            var number = new Date().getTime();
            let el = ``;
            $.map(pathes, item => {
               el += `<img src="${item}" width="100" class="rouned p-2"/>`
            });
            $(div).append(`<div class="d-flex"><div><input type="hidden" data-type="album" value="${pathes}" style="width:500px" class="form-control my-2 myElm">
                            </div>${el} <span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);
        }

        function addList(){
            var div = document.getElementById('page');
            $(div).append(`<div class="d-flex"><textarea data-type="list" class="form-control my-2 myElm"></textarea><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);
        }

        function previewImage(event, id){
            let image = document.getElementById(id);
            image.src = URL.createObjectURL(event.target.files[0]);
            image.classList.remove('d-none');
        }

        function previewVideo(event, id){
            let video = document.getElementById(id);
            console.log(video);
            let file = URL.createObjectURL(event.target.files[0]);
            video.innerHTML = `<video width="320" height="240" controls>
                             <source src="${file}">
                           </video>`;
        }

        function store(){

            $.ajax({
                url: 'http://{{ $_SERVER['HTTP_HOST'] }}/store',
                data: { data: JSON.stringify(getElements())},
                type: 'POST',
                success: function(result) {
                    window.location.replace("http://{{ $_SERVER['HTTP_HOST'] }}/");
                }
            });

            function getElements(){
                let data = [];
                $.map($('.myElm'), (item)=>{

                    let input_val = item.value;

                    if(item.dataset.type == 'album'){
                        input_val = item.value.split(",");
                    }
                    if(item.dataset.type == 'list'){
                        input_val = item.value.split("\n");
                    }
                    let ob = {
                        'type':item.dataset.type,
                        'value': input_val
                    };
                    data.push(ob);
                });
                return data;
            }
        }

        function upload(id, path,t){
            var formData = new FormData(document.getElementById(id));
            $.ajax({
                url: path,
                type: "POST",
                data: formData ,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    console.log('upload successfully');
                    getImages(t);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function removeElm(el){
            $(el).remove();
        }

        function openAlbumDialog(t){
            $('#toolsModal').modal('hide');
            getImages(t);
            t == 'for-slider' ? $('#albumModalForSlider').modal('show') : $('#albumModal').modal('show');
        }

        function getImages(t){
            window.pathes = [];
            $.ajax({
                url:'/images',
                type: 'get',
                success: function (response) {

                    $('#albumModal .content,#albumModalForSlider .content').html('');
                    if(t=='for-slider'){
                        $.map(response, item => {
                            $('#albumModalForSlider .content').append(`<div class="col-md-3">
                                <img src='${item.path}' style="cursor: pointer" class="w-100"
                                onclick="window.pathes.push('${item.path}');$(this).css('border', '3px solid #00e100')">
                                </din>`);
                        });
                        $('#albumModalForSlider .save-and-exit').html(`<a class="btn btn-light px-5 mt-4" onclick="addGallery(pathes)" data-bs-dismiss="modal">Done</a>`)
                    }else{
                        $.map(response, item => {
                            $('#albumModal .content').append(`<div class="col-md-3">
                                <img src='${item.path}' style="cursor: pointer" onclick="addImage('${item.path}')" class="w-100">
                                </din>`);
                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
        }

    </script>
@endsection
