@extends('main')


@section('content')
    <div class="container mt-5">
        <div id="page"></div>
        <!-- Button trigger modal -->
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-success m-4" data-bs-toggle="modal" data-bs-target="#exampleModal">+</button>
            </div>
            <div>
                <button onclick="store()" type="button" class="btn btn-success m-4">
                    Save
                    <i class="mdi mdi-content-save"></i>
                </button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="d-flex justify-content-center">
                                <div style="cursor: pointer;" data-bs-dismiss="modal" onclick="addImage()" class="text-center mx-4 shadow-sm p-4 mb-5 bg-white rounded">
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

                                <div style="cursor: pointer;" data-bs-dismiss="modal" onclick="addGallery()" class="text-center mx-4 shadow-sm p-4 mb-5 bg-white rounded">
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

        function addImage(){
            var div = document.getElementById('page');
            var number = new Date().getTime();
            $(div).append(`<div class="d-flex"><div><form id="form-${number}" enctype="multipart/form-data"><input type="file" name="image" data-type="image" onchange="previewImage(event, 'preview-image-'+${number})" class="form-control my-2 myElm"></form>` +
                `<div class="text-center"><img id="preview-image-${number}" class="d-none" src="" width="144" height="81"></div><span onclick="upload('form-'+${number}, 'http://{{ $_SERVER['HTTP_HOST'] }}/image-upload')" class="btn btn-warning">Upload</span></div><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);
        }

        function addVideo(){
            var div = document.getElementById('page');
            var number = new Date().getTime();
            $(div).append(`<div class="d-flex"><input type="text" data-type="video" class="form-control my-2 myElm"><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);

            {{--$(div).append(`<div class="d-flex"><div><form id="form-${number}" enctype="multipart/form-data"><input name="video" type="file" data-type="video" onchange="previewVideo(event, 'preview-video-'+${number})" class="form-control my-2 myElm"></form>` +--}}
            {{--    `<div class="text-center" id="preview-video-${number}"></div><span onclick="upload('form-'+${number}, 'http://{{ $_SERVER['HTTP_HOST'] }}/video-upload')" class="btn btn-warning">Upload</span></div><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);--}}
        }

        function addGallery(){
            var div = document.getElementById('page');
            var number = new Date().getTime();
            $(div).append(`<div class="d-flex"><div><form id="form-${number}" enctype="multipart/form-data"><input type="file" name="album[]" data-type="album" onchange="previewImage(event, 'preview-image-'+${number})" class="form-control my-2 myElm" multiple></form>` +
                `<div class="text-center"><img id="preview-image-${number}" class="d-none" src="" width="144" height="81"></div><span onclick="upload('form-'+${number}, 'http://{{ $_SERVER['HTTP_HOST'] }}/gallery-upload')" class="btn btn-warning">Upload</span></div><span onclick="removeElm(this.parentElement)" class="btn-close"></span></div>`);
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
                    console.log('success');
                    window.location.replace("http://{{ $_SERVER['HTTP_HOST'] }}/");
                }
            });

            function getElements(){
                let data = [];
                $.map($('.myElm'), (item)=>{

                    let input_val = item.value;
                    let path = [];

                    if(item.files){
                        $.map(item.files, (file,index) => {
                            input_val = "";
                            path[index] = 'http://{{ $_SERVER['HTTP_HOST'] }}/storage/' + item.dataset.type + 's/' + file.name;
                        });
                    }
                    if(item.dataset.type == 'list'){
                        input_val = item.value.split("\n");
                    }
                    let ob = {
                        'type':item.dataset.type,
                        'value': input_val,
                        'path': path
                    };
                    data.push(ob);

                    console.log(ob)
                });
                return data;
            }
        }

        function upload(id, path){
            var formData = new FormData(document.getElementById(id));
            $.ajax({
                url: path,
                type: "POST",
                data: formData ,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    console.log('upload successfully')
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function removeElm(el){
            $(el).remove();
        }

    </script>
@endsection