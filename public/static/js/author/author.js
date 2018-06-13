
     var $list=$("#fileList");   //这几个初始化全局的百度文档上没说明，好蛋疼
           var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档  
           var thumbnailHeight = 100;  
           var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
           swf: '__PUBLIC__/webuploader/uploader.swf', //加载swf文件，路径一定要对
            // 文件接收服务端。
            server: '{:url("author/author/ajaxUpload")}',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            // 只允许选择图片文件。
            accept: {
              title: 'Images',
              extensions: 'gif,jpg,jpeg,bmp,png',
              mimeTypes: 'image/'
            },
            fileNumLimit: 1, //限制上传个数
        });
      //上传完成事件监听
      uploader.on( 'fileQueued', function(file) {
        var $li = $(
          '<div id="' + file.id + '" class="file-item thumbnail">' +
          '<img>' +
          '</div>'
          ),
        $img = $li.find('img');
            // $list为容器jQuery实例
            $list.append( $li );
            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
              if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
              }
              $img.attr( 'src', src );
            }, thumbnailWidth, thumbnailHeight );
            uploader.on('uploadSuccess',function(file,ret){
              if(ret.status==1){
                alert('上传成功！');
              }
            })
        });