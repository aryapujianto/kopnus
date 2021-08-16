@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users
                    <button class="btn btn-sm btn-primary rounded-pill float-right" data-toggle="modal" type="button" data-target="#modalForm">Create</button>
                </div>

                <div class="card-body">
                    <div class="list-users">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="7">No Data</td></tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('users.form')
@endsection
@push('js')
    <script>
        let User = {
            isEdit:false,
            id:undefined,
            load(){
                const _this = this
                $.ajax({
                    type: "get",
                    url: "/api/users",
                    dataType: "json",
                    success: function (response) {
                        if(response.length>0){
                            $('.list-users tbody').html(``)
                            let list = '';
                            $.each(response, function (i, v) {
                                $('.list-users tbody').append(_this.createList(i,v))
                            });

                        }else{
                            $('.list-users tbody').html(`<tr><td colspan="7">No Data</td></tr>`)
                        }

                    }
                });
            },
            createList(index,data){
                const date = moment(data.created_at, "YYYY-MM-DD hh:mm:ss").format("DD-MM-YYYY hh:mm");
                return `<tr>
                    <th>${index+1}</th>
                    <td>${data.name}</td>
                    <td>${data.email}</td>
                    <td>${data.phone}</td>
                    <td>${data.address}</td>
                    <td>${date}</td>
                    <td>
                        <button class="btn btn-sm btn-danger rounded-pill float-right" onClick="return User.delete(${data.id})">Delete</button>
                        <button class="btn btn-sm btn-primary rounded-pill float-right" data-toggle="modal" type="button" data-target="#modalForm" data-id="${data.id}">Edit</button>
                    </td>
                </tr>`
            },
            loading(type){
                if(type=='show'){
                    $('.loading').removeClass('d-none')
                }else{
                    $('.loading').addClass('d-none')
                }
            },
            onModalShow(){
                const _this = this
                $('#modalForm').on('show.bs.modal', function (e) {
                    const id = $(e.relatedTarget).data('id');
                    _this.id = id
                    if(typeof id !== 'undefined'){
                        _this.isEdit = true
                        $('#modalForm').find('.modal-title').text('Edit User')
                        _this.loadEdit()
                    }
                    else{
                        _this.isEdit = false
                        $('#modalForm').find('.modal-title').text('Create User')
                    }
                })
            },
            onModalHide(){
                const _this = this
                $('#modalForm').on('hide.bs.modal', function (e) {
                    _this.reset()
                })
            },
            reset(){
                this.isEdit = false
                this.id = undefined
                $('#form').find('.alert').remove()
                $('#form').trigger('reset')
            },
            alert(msg,type){
                return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${msg}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`
            },
            onSubmit(){
                const _this = this
                $(document).on('submit', '#form', function (e) {
                    e.preventDefault();
                    _this.loading('show')
                    const formData = new FormData(document.getElementById('form'));
                    $.ajax({
                        type: 'post',
                        url: (_this.isEdit) ? `/api/users/${_this.id}` : '/api/users',
                        processData: false,
                        contentType: false,
                        data: formData,
                        dataType: 'json',
                        success: function (response) {
                            _this.loading('hide')
                            $('.list-users').before(_this.alert('User has been added!','success'))
                            $('#modalForm').modal('toggle')
                            _this.load()
                        },
                        error: function (response) {
                            let message = $('<ul/>');
                            $.each(response.responseJSON.errors, function (i, v) {
                                $.each(v, function (ij, vj) {
                                    message.append($(`<li>${vj}</li>`))
                                })
                            });
                            console.log(response.responseJSON.errors);
                            $('#form').find('.modal-body').prepend(_this.alert(message.html(),'danger'))
                            _this.loading('hide')
                        }
                    });
                });
            },
            loadEdit(){
                const _this = this
                $.ajax({
                    type: "get",
                    url: "/api/users/"+_this.id,
                    dataType: "json",
                    success: function (response) {
                        $.each(response.user, function (i, v) {
                            $('#form').find(`input[name="${i}"],textarea[name="${i}"]`).val(v)
                        });
                    }
                });
            },
            delete(id){
                const _this = this
                $.ajax({
                    type: "delete",
                    url: "/api/users/"+id,
                    dataType: "json",
                    success: function (response) {
                        $('.list-users').before(_this.alert('User has been deleted!','success'))
                        _this.load()
                    }
                });
            }
        }
        jQuery(function () {
            User.load()
            User.onModalShow()
            User.onModalHide()
            User.onSubmit()
        });
    </script>
@endpush
