@extends('layouts.app')
@section('style')
    <style>
        .post h2,.post p{width:100px}
        .py-4{padding: 0px !important }
        .wall{padding-top: 30px !important}
    </style>
@endsection
@section('menu')
<a class="dropdown-item" href="{{ route('home') }}">
        {{ __('home') }}
</a>

<a class="dropdown-item" href="{{ route('editprofile') }}">
    {{ __('Edit Profile') }}
</a>

<a class="dropdown-item" href="{{ route('changepass') }}">
    {{ __('Change password') }}
</a>
@endsection


@section('content')
<div class="wall" style="background-color:#f1f5f9;">

        <div class="container" >
                <div class="row ">
                        <div class="col-12 row" style="padding-left:0px">
                            <div class="col-4 offset-5">
                                <img  style=" border-radius: 50%;width:200px;height:200px;" src="storage/upload/{{$user->image_url}}">
                            </div>
                        </div>
                    
                    
                           <div class="col-12 " style="margin-top:20px" >
                                <div class="text-center">     <!-- col-8 offset-4   -->
                                    <h3 class="title">{{$user->name}}</h3>
                            </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="text-center">
                                    <p class="category">{{$user->bio}}</p>
                            </div>
                            </div>
                            <div class="col-12 row" style="padding-left:0px">
                                <div class="row col-3 offset-5 post">
                                    <div class="col-3 text-center commentCount">
                                            <h2>{{$user->comments->count()}}</h2>
                                            <p>Comments</p>
                                    </div>
                                
                                    <div class=" col-3 offset-2 text-center">
                                            <h2>{{$user->posts->count()}}</h2>
                                            <p>Posts</p>
                                    </div>
                        
                                </div>
                            </div>
                </div>
                
        </div>



</div>

<div class="col-md-6 offset-md-3 gedf-main">
    <div class="posts">
            <div class="container">

                @foreach($user->posts as $p) 
                <div class="card gedf-card post-{{$p->id}}" style="margin-top:10px;margin-bottom:10px;">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" height="45" src="storage/upload/{{$p->user->image_url}}" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0" style="text-transform:capitalize;font-weight:initial;">{{$p->user->name}}</div>
                                </div>
                            </div>
                            <div>
                                @if($p->user_id == $user->id)
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <a class="dropdown-item" id="post-edit-{{$p->id}}" href="" data-toggle="modal" onclick="        edit_delete('post','edit','{{$p->id}}')"
                                        data-target="#edit-delete">Edit</a>
                                            <a class="dropdown-item" id="post-delete-{{$p->id}}" href="" data-toggle="modal" onclick=" edit_delete('post','delete','{{$p->id}}')" data-target="#edit-delete">Delete</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
        
                    </div>
                    <div class="card-body">
                            <div class="text-muted h7 mb-2"> 
                                <i class="fa fa-clock-o" style="padding-right:5px"></i>
                                {{$p->updated_at->diffForHumans()}}
                            </div>
                            <p class="card-text">
                                {{$p->body}}
                            </p>
                    </div>
                    <div class="cardbox-base" style="background-color:rgba(0, 0, 0, 0.03);">
                        <ul class="float-right" style="width: 90.014px;">
                            <li><a><i class="fa fa-comments"></i></a></li>
                            @if($p->comments->count() > 0)
                                <li><a><em class="mr-5">{{$p->comments->count()}}</em></a></li>
                            @endif
                        </ul>
                        <ul class="likes" style="padding-left:40px !important">
                            <li><a><i id="{{$p->id}}" class="fa fa-thumbs-up like" style="cursor:pointer; color:#8d8d8d5"></i></a></li>                            
                            @if($p->likes->count() > 0) 
                                <li class="count"><a><span>{{$p->likes->count()}} Likes</span></a></li>
                            @endif
                        </ul>			   
                    </div> 
                    <ul class="list-group list-group-flush comments_{{$p->id}}">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-1">      
                                        <img class="rounded-circle" width="35" height="35" src="storage/upload/{{$user->image_url}}" alt="">
                                    </div>
                                    <div class="col-sm-11 input_{{$p->id}}">
                                        <input type="text" name="text" id="{{$p->id}}" class="form-control commentt">
                                    </div>
                                    
                                </div>
                            </li>
                            @if($p->comments->count() > 0)
                                @foreach ($p->comments as $comment)
                                    <li class="list-group-item comment-{{$comment->id}}">
                                        <div class="d-flex  align-items-center row">
                                            <div class="d-flex  align-items-center col-1">
                                                    <div class="mr-2">
                                                        <img class="rounded-circle" width="35px" height="35px" src="storage/upload/{{$comment->user->image_url}}" alt="">
                                                    </div>
                                            </div>
                                            <div class="col-10 ">
                                                <div class="h5 comment-text" style="font-size:15px;">{{$comment->text}}</div>
                                            </div>
                                            <div class="col-1">
                                                @if($comment->user->id == $user->id)
                                                    <div class="dropdown">
                                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop2"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop2">
                                                            <a class="dropdown-item" id="comment-edit-{{$comment->id}}-{{$p->id}}" 
                                                            onclick=" edit_delete('comment','edit','{{$comment->id}}','{{$p->id}}')" 
                                                            href="" data-toggle="modal" data-target="#edit-delete">Edit</a>

                                                            <a class="dropdown-item" id="comment-delete-{{$comment->id}}-{{$p->id}}"
                                                            onclick=" edit_delete('comment','delete','{{$comment->id}}','{{$p->id}}')" href="" data-toggle="modal" data-target="#edit-delete">Delete</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                            
                    </ul>
                </div>
            
            @endforeach 
           
            <div class="modal fade" id="edit-delete" tabindex="-1" role="dialog" aria-labelledby="editLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="title">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary save">Save changes</button>
                    </div>
                  </div>
                </div>
            </div>
               
    
            </div>
    
    </div>   
</div>
@endsection

@section('script')
<script>
        
        

        
    $(document).ready(function(){
        
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var user_id = {!! json_encode($user) !!}.id;
        var user = {!! json_encode($user) !!};
        $.each(user.posts,function(key,value){
            $.each(value.likes,function(k,v){
                if(v.id == user_id) {
                    $('.likes i#'+value.id).css('color','#3f9ae5');
                }
            });
        });


        
        $(".commentt").on("keypress",function(e){
            
            
                if(e.keyCode == 13)
                {
                    var id = $(e.target).attr("id");
                    var that = $(this);
                    var text = $(this).val();
                    if(text != null) 
                    { 
                        
                        $.ajax({

                            type:'POST',

                            url:'comment/create',

                            data:{text:text, post_id:id,_token: $('meta[name="csrf-token"]').attr('content')},

                            success:function(data){
                            
                            $(".comments_"+data.comment.post_id).append(
                                    '<li class="list-group-item comment-'+data.comment.id+'">'+
                                        '<div class="d-flex  align-items-center row">'+
                                            '<div class="d-flex  align-items-center col-1">'+
                                                    '<div class="mr-2">'+
                                                        '<img class="rounded-circle" width="35" height="35" src="storage/upload/'+data.image+'" alt="">'+
                                                    '</div>'+
                                            '</div>'+
                                            '<div class="col-10">'+
                                                '<div class="h5 comment-text" style="font-size:15px;">'+data.comment.text+'</div>'+
                                            '</div>'+
                                            '<div class="col-1">'+
                                                
                                                    '<div class="dropdown">'+
                                                        '<button class="btn btn-link dropdown-toggle" type="button"'+ 
                                                        'id="gedf-drop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                                        '</button>'+
                                                        '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop2">'+
                                                            '<a class="dropdown-item" id="comment-edit-'+data.comment.id+'-'+data.comment.post_id+'" href="" data-toggle="modal" onclick="edit_delete(\'comment\',\'edit\',\''+data.comment.id+'\',\''+data.comment.post_id+'\')" data-target="#edit-delete">Edit</a>'+
                                                        '<a class="dropdown-item" id="comment-delete-'+data.comment.id+'-'+data.comment.post_id+'" href="" data-toggle="modal" onclick="edit_delete(\'comment\',\'delete\',\''+data.comment.id+'\',\''+data.comment.post_id+'\')" data-target="#edit-delete">Delete</a>'+
                                                        '</div>'+
                                                    '</div>'+
                                                
                                            '</div>'+
                                        '</div>'+
                                    '</li>'
                            );
                            that.val(' ');

                            }

                        });
                    }
                    
                }
            
        });

        
        $(".like").on("click",function(){
            var id = $(this).attr('id');
            $.ajax({
                type:'POST',

                url:'like/create',

                data:{post_id:id,_token: $('meta[name="csrf-token"]').attr('content')},

                success:function(data){
                    if(data.flag == 0){
                        $("#"+id).css('color','#908d8b');
                        
                    }else {
                        $("#"+id).css('color','#3f9ae5');
                    }
                    $("#"+id).parents('ul').children('.count').remove();
                    if(data.count != 0) {
                        $("#"+id).parents('ul').append(
                            '<li class="count"><a><span>'+data.count+' Likes</span></a></li>'
                        );  
                    }
                    
                   
                }
            });            
        });

        $('.save').on("click",function() { 
            var array = $('.save').attr('id').split("-");
            var type = array[0];
            var method = array[1];
            var id = array[2];
            if(type == "post") {
                if(method == 'edit')
                {
                    var text = $(".edit textarea").val();
                    $.ajax({

                        type:'POST',

                        url:'post/edit',

                        data:{post_id:id,body:text,_token: $('meta[name="csrf-token"]').attr('content')},

                        success:function(data){
                            $(".post-"+data.post.id+" .card-body").html(
                                '<div class="text-muted h7 mb-2">'+ 
                                    '<i class="fa fa-clock-o" style="padding-right:5px"></i>'+
                                        data.time+
                                '</div>'+
                                '<p class="card-text">'+
                                    data.post.body+
                                '</p>'
                            );
                            $('#edit-delete').modal('hide');
                        }

                    });
                } else {
                    $.ajax({

                        type:'POST',

                        url:'post/delete',

                        data:{post_id:id,_token: $('meta[name="csrf-token"]').attr('content')},

                        success:function(data){
                            $(".post-"+id).remove();
                            $('#edit-delete').modal('hide');
                        }

                    });
                }
            } else {
                if(method == 'edit'){
                    var text = $(".edit textarea").val();
                    $.ajax({

                        type:'POST',
                        url:'editcomment',
                        data:{id:id,text:text,_token: $('meta[name="csrf-token"]').attr('content')},

                        success:function(data){
                            $(".comment-"+id+" .comment-text").html(
                                data.comment.text
                            );
                            $('#edit-delete').modal('hide');
                        },

                    });
                } else {
                    $.ajax({

                        type:'POST',
                        url:'{{route("deleteComment")}}',
                        data:{id:id,_token: $('meta[name="csrf-token"]').attr('content')},
                        success:function(data){
                            $(".comment-"+id).remove();
                            $('#edit-delete').modal('hide');
                            

                        },

                    });
                } 
             }   
             $(".modal .modal-footer .save").attr("id",' ');
        });
        
        

    });
    
    function edit_delete(type,method,id,post_id = null) 
    {
        //console.log(type+","+method+","+id);
        $(".modal .modal-footer .save").attr("id",' ');
        if(type == "post") {
            if(method == 'edit')
            {

                var text = $(".post-"+id+" .card-body .card-text").html().trim();
                $(".modal .modal-title").html('Edit Post');
                $(".modal .modal-body").html(
                '<div class="tab-content edit" id="myTabContent">'+
                        '<div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">'+
                            '<div class="form-group">'+
                                '<label class="sr-only" for="message">post</label>'+
                                '<textarea class="form-control" id="message" rows="3"'+
                                    'placeholder="What are you thinking?" name="body">'+text+'</textarea>'+
                            '</div>'+
                            '<div class="form-group">'+
                                
                                    '@foreach($errors->all() as $error)'+
                                        '<span class="invalid-feedback" role="alert">'+
                                            '<strong>{{ $error }}</strong>'+
                                        '</span>'+
                                    '@endforeach'+
                                
                            '</div>'+
                        '</div>'+
                    '</div> '
                );
                
                $(".modal .modal-footer .save").html("Save Changes");
                $(".modal .modal-footer .save").attr("id",'post-edit-'+id);
               
                

            }else if(method == "delete"){
                $(".modal .modal-title").html('Delete Post');
                $(".modal .modal-body").html("Are you want Delete it");
                $(".modal .modal-footer .save").html("Delete");
                $(".modal .modal-footer .save").attr("id",'post-delete-'+id);
                


            }
        } else if (type == 'comment') {
            if(method == 'edit')
            {
                var text = $(".comment-"+id+" .comment-text").html().trim();
                $(".modal .modal-title").html('Edit Comment');
                $(".modal .modal-body").html(
                '<div class="tab-content edit" id="myTabContent">'+
                        '<div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">'+
                            '<div class="form-group">'+
                                '<label class="sr-only" for="message">post</label>'+
                                '<textarea class="form-control" id="message" rows="3"'+
                                    'placeholder="What are you thinking?" name="body">'+text+'</textarea>'+
                            '</div>'+
                            '<div class="form-group">'+
                                
                                    '@foreach($errors->all() as $error)'+
                                        '<span class="invalid-feedback" role="alert">'+
                                            '<strong>{{ $error }}</strong>'+
                                        '</span>'+
                                    '@endforeach'+
                                
                            '</div>'+
                        '</div>'+
                    '</div>'
                );
                $(".modal .modal-footer .save").html("Save Changes");
                $(".modal .modal-footer .save").attr("id",'comment-edit-'+id+"-"+post_id);

            } else if(method == "delete"){
                $(".modal .modal-title").html('Delete Comment');
                $(".modal .modal-body").html("Are you want Delete it");
                $(".modal .modal-footer .save").html("Delete");
                $(".modal .modal-footer .save").attr("id",'comment-delete-'+id+"-"+post_id);
                
            }
        }
    }
    
</script>
@append