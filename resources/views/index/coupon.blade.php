<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('/test')}}">
        <input type="text" name="" id=""><input type="submit" name="" id="">
    </form>
</body>
</html>
<button id="quan">满100-20</button>
<script type="text/javascript" src="/static/js/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).on('click','#quan',function(){
        $.ajax({

            url:'/couponadd',
            type:'get',
            dataType:'json',
            success:function(res){
                alert(res)
            }
        })
    });
</script>
