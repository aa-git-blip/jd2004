<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 color="re">抽奖页面</h1>
    <button id="btn-prize" style="background-color: aquamarine">开始抽奖</button>
    <script type="text/javascript" src="/static/js/plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).on('click','#btn-prize',function(){
            // alert(111);
            $.ajax({
                url:"/add",
                type:"get",
                dataType:'json',
                success:function(res){
                    if(res.error==30000)
                    {
                        alert('您今天的抽奖次数达到上限,wdnmd')
                    }
                    if(res.data.level==0)
                    {
                        alert('谢谢参与')
                    }
                    if(res.data.level==1)
                    {
                        alert('恭喜您获得一等奖')
                    }
                    if(res.data.level==2)
                    {
                        alert('恭喜您获得二等奖')
                    }
                    if(res.data.level==3)
                    {
                        alert('恭喜你获得三等奖')
                    }

                    //alert(res.data.prize)
                }
            })
        })
    </script>
</body>
</html>
