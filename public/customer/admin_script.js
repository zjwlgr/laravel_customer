$(function(){

    $loadimg = '<img src="/image/loaders/1.gif" />';
    $csrf = $("meta[name='csrf-token']").attr('content');
    String.prototype.trim=function() {
        return this.replace(/(^\s*)|(\s*$)/g,'');
    }

    /*管理员登录验证*/
    $("#form1_login").bind("submit", function(){
        var  $username = $("#username"),$password = $("#password"),$validates = $("#validate");
        if($username.val() == ""){
            art.dialog({lock: true,opacity: 0.5,content: "用户名不能为空！",icon: 'warning',ok: function(){$username.focus();}});
            return false;
        }
        if($password.val() == ""){
            art.dialog({lock: true,opacity: 0.5,content: "密码不能为空！",icon: 'warning',ok: function(){$password.focus();}});
            return false;
        }
    });

    /*左侧收缩效果*/
    if($(".sidebar-menu").length > 0){
        var $ulsub = $(".sidebar-menu > ul > li:first-child");
        $ulsub.addClass('open').children('.sub').slideDown(0);
        $ulsub.children('a').children('.arrow').removeClass('glyphicon-triangle-left').addClass('glyphicon-triangle-bottom');
    }//第一个默认展开，纯属多余 暂时保留
    $(document).delegate('a.offsite','click', function(){
        var $hasid = $(this).attr('id');
        var $sub = $(this).next();
        var $glyphicon = $(this).children('.arrow');
        if($sub.is(":visible")){
            $(this).parent().removeClass('open');
            $glyphicon.removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-left');
            $sub.slideUp(200);
        }else{
            /*展开当前块，关闭已展开块*/
            $(".has-sub > ul.sub:visible").parent().removeClass('open');
            $(".has-sub > ul.sub:visible").parent().children('a').children('.arrow').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-left');
            $(".has-sub > ul.sub:visible").slideUp(200);
            /*展开当前点击的功能组*/
            $(this).parent().addClass('open');
            $glyphicon.removeClass('glyphicon-triangle-left').addClass('glyphicon-triangle-bottom');
            $sub.slideDown(200);
        }
    });//点击展开收起

    /*左侧点击选中状态 && 展开当前功能所在组*/
    if($(".has-sub").length > 0){
        var $pathname = window.location.pathname;
        var $pathname_ar = $pathname.split('/');
        $(".has-sub > .sub >li a").each(function(){
            var $href = $(this).attr('href');//获取href
            var $htre_ar = $href.split('/');//拆分为数组
            //alert($pathname_ar[1]+'---'+$htre_ar[3]);
            if($pathname_ar[1] == $htre_ar[3] && $htre_ar[3] != undefined){
                $(this).addClass('cur');//选中对应功能列
                /*展开当前块，关闭已展开块*/
                $(".has-sub > ul.sub:visible").parent().removeClass('open');
                $(".has-sub > ul.sub:visible").parent().children('a').children('.arrow').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-left');
                $(".has-sub > ul.sub:visible").slideUp(0);
                /*展开对应功能所在组*/
                $(this).parent().parent().parent().addClass('open');
                $(this).parent().parent().parent().children('.arrow').removeClass('glyphicon-triangle-left').addClass('glyphicon-triangle-bottom');
                $(this).parent().parent().slideDown(0);
            }
        });
    }

    /*功能组 选择时操作*/
    $("#function_group > li > a").bind('click', function(){
        var $i = $(this).attr('_i');
        var $t = $(this).html();
        $(this).parent().parent().prev().children('#text').html($t);
        $(this).parent().parent().parent().removeClass('open');
        $("#fid").val($i);
        if($i == 0){
            $("#fidname").val('').attr('disabled',false);
        }else{
            $("#fidname").val($t).attr('disabled',true);
        }
        return false;
    });

    /*add funciton submit operation*/
    $("#form1_function").bind('submit', function(){
        if($('#fidname').val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: '请选择或输入功能组名称',icon: 'warning',ok: function(){}});
            return false;
        }
        if($('#fname').val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: "请输入功能名称！",icon: 'warning',ok: function(){$('#fname').focus();}});
            return false;
        }
        if($('#furi').val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: "请输入功能URI！",icon: 'warning',ok: function(){$('#furi').focus();}});
            return false;
        }
    });

    /*删除操作的 confirm*/
    $(".delete").bind('click', function(){
        var $m = $(this).attr('_m');
        var $href = $(this).attr('href');

        var $d = $(this).attr('_d');
        if($d != 0 && $d != undefined){
            art.dialog({lock: true,opacity: 0.5,content: "请先删除功能组下面的功能！",icon: 'error',ok: function(){$('#furi').focus();}});
            return false;
        }//========================满足条件删除，删功组

        if($m == '' || $m == undefined){$m = '确定要删除该信息？一旦删除将不能回复！';}
        art.dialog({
            lock: true, opacity: 0.5, icon: 'question',
            content: $m,
            ok: function () {
                window.location.href = $href;
                return true;
            },
            cancelVal: '关闭',
            cancel: true //为true等价于function(){}
        });

        return false;
    });

    /*下拉菜单选择时操作*/
    $(document).delegate('#dropdownMenuone > li > a','click',function(){
    //$("#dropdownMenuone > li > a").bind('click', function(){
        var $i = $(this).attr('_i');
        var $t = $(this).html();
        $(this).parent().parent().prev().children('#text').html($t);
        $(this).parent().parent().next().val($i);
        $(this).parent().parent().parent().removeClass('open');
        return false;
    });

    /*搜索提示为空*/
    $("#form1_search").bind('submit', function(){
        if($("#search").val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: "请输入要搜索的关键字！",icon: 'warning',ok: function(){$('#search').focus();}});
            return false;
        }
    });

    /*管理员录入时间显示*/
    $("[data-toggle='tooltip']").tooltip();

    /*管理员分组 权限部分 点击变为蓝色字*/
    var i = 1;
    $(".checkboxclick").bind('click', function(){
        var yu = i % 2;
        if(yu == 0) {
            var $this = $(this);
            if ($this.children('input').attr('checked')) {
                $this.children('input').attr('checked',false);
                $this.removeClass('ceboxse');
            } else {
                $this.children('input').attr('checked',true);
                $this.addClass('ceboxse');
            }
        }
        i = i + 1;
    });

    /*管理员新增 提交判断*/
    $("#form1_manager").bind('submit', function(){
        if($("#group_id").val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: "请选择用户组！",icon: 'warning',ok: function(){}});
            return false;
        }
        if($('#username').val().length < 3 || $('#username').val().length > 18){
            art.dialog({lock: true,opacity: 0.5,content: "请输入用户名，长度范围 3 - 18 位！",icon: 'warning',ok: function(){$('#username').focus();}});
            return false;
        }
        if($('#id').length == 0){//如果新增，判断密码不能为空
            if($('#password').val() == ""){
                art.dialog({lock: true,opacity: 0.5,content: "请输入密码，长度范围 6 - 18 位！",icon: 'warning',ok: function(){$('#password').focus();}});
                return false;
            }
        }
        if($('#password').val() != "") {//如果密码不为空，判断密码长度，和重复密码
            if($('#password').val().length < 6 || $('#password').val().length > 18){
                art.dialog({lock: true,opacity: 0.5,content: "请输入密码，长度范围 6 - 18 位！",icon: 'warning',ok: function(){$('#password').focus();}});
                return false;
            }
            if($('#password').val() != $('#repassword').val()){
                art.dialog({lock: true,opacity: 0.5,content: "两次密码不一致，请重新输入！",icon: 'warning',ok: function(){$('#repassword').focus();}});
                return false;
            }
        }
        if($('#uname').val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: "请输入管理员姓名！",icon: 'warning',ok: function(){$('#uname').focus();}});
            return false;
        }
    });

    /*修改密码 提交判断*/
    $("#form1_editpwd").bind('submit', function(){
        if($('#oldpassword').val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: "请输入旧密码！",icon: 'warning',ok: function(){$('#oldpassword').focus();}});
            return false;
        }
        if($('#password').val().length < 6 || $('#password').val().length > 18){
            art.dialog({lock: true,opacity: 0.5,content: "请输入密码，长度范围 6 - 18 位！",icon: 'warning',ok: function(){$('#password').focus();}});
            return false;
        }
        if($('#password').val() != $('#repassword').val()){
            art.dialog({lock: true,opacity: 0.5,content: "两次密码不一致，请重新输入！",icon: 'warning',ok: function(){$('#repassword').focus();}});
            return false;
        }
    });

    $('#form1_infomation').bind('submit', function () {
        if($('#name').val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: "请输入姓名！",icon: 'warning',ok: function(){$('#name').focus();}});
            return false;
        }

        if($('#phone').val() == '' || !$("#phone").val().match(/^1(3|4|5|6|7|8|9)\d{9}$/)){
            art.dialog({lock: true,opacity: 0.5,content: "请输入正确的手机号！",icon: 'warning',ok: function(){$('#phone').focus();}});
            return false;
        }

        if($('#sex').val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: "请选择性别！",icon: 'warning',ok: function(){}});
            return false;
        }

        if($('#imyear').val() == ''){
            art.dialog({lock: true,opacity: 0.5,content: "请选择出生年！",icon: 'warning',ok: function(){}});
            return false;
        }
    });

    $('#phone').bind('blur', function () {
        var phone = $(this).val();
        if(phone != '') {
            if (!phone.match(/^1(3|4|5|6|7|8|9)\d{9}$/)) {
                art.dialog({
                    lock: true, opacity: 0.5, content: "请输入正确的手机号！", icon: 'warning', ok: function () {
                        $('#phone').focus();
                    }
                });
                return false;
            } else {
                $.get('/ajaxPhone.jay', {phone: phone}, function (data) {
                    if (data.code == 0) {
                        $('.glyphicon-ok').show().text(data.msg);
                        $('.glyphicon-remove').hide();
                    } else if (data.code == 1) {
                        $('.glyphicon-remove').show().text(data.msg);
                        $('.glyphicon-ok').hide();
                    }
                });
            }
        }
    });

    $('#phone2').bind('blur', function () {
        var phone = $(this).val();
        if(phone != '') {
            if (!phone.match(/^1(3|4|5|6|7|8|9)\d{9}$/)) {
                art.dialog({
                    lock: true, opacity: 0.5, content: "请输入正确的手机号！", icon: 'warning', ok: function () {
                        $('#phone2').focus();
                    }
                });
                return false;
            } else {
                $.get('/ajaxPhoneResume.jay', {phone: phone}, function (data) {
                    if (data.code == 0) {
                        $('.glyphicon-ok').show().text(data.msg);
                        $('.glyphicon-remove').hide();
                    } else if (data.code == 1) {
                        $('.glyphicon-remove').show().text(data.msg);
                        $('.glyphicon-ok').hide();
                    }
                });
            }
        }
    });

    $('.detail_model').bind('click', function () {
        var id = $(this).attr('href');

        $.get('/ajaxDetail.jay',{id:id},function (data) {
            $('#name').text(data.name);
            $('#phone').text(data.phone);
            $('#sex').text(data.sex);
            $('#imyear').text(data.imyear);
            $('#age').text(data.age);
            $('#matrimony').text(data.matrimony == null ? '' : data.matrimony);
            $('#bear').text(data.bear == null ? '' : data.bear);
            $('#qq').text(data.qq);
            $('#weixin').text(data.weixin);
            $('#origin').text(data.origin);
            $('#position').text(data.position);
            $('#currently').text(data.currently);
            $('#industry').text(data.industry == null ? '' : data.industry);
            $('#development').text(data.development == null ? '' : data.development);
            $('#opportunity').text(data.opportunity == null ? '' : data.opportunity);
            $('#potential').text(data.potential == null ? '' : data.potential);
            $('#contribution').text(data.contribution == null ? '' : data.contribution);
            $('#tiveness').text(data.tiveness == null ? '' : data.tiveness);
            $('#enterprises').text(data.enterprises == null ? '' : data.enterprises);
            $('#importance').text(data.importance == null ? '' : data.importance);
            $('#divided').text(data.divided);
            $('#dividedd').text(data.dividedd);
            $('#recommend').text(data.recommend);
            $('#describe').text(data.describe);
            $('#note').text(data.note);
            $('#create_at').text(data.created_at);
            $('#admin_id').text(data.admin_id);


            $('#myModal').modal('show')
        });

        return false;
    });

    if($('#model_success').length > 0){
        setTimeout(function () {
            $('#model_success').children('button').click();
        },2300);
    }

    laydate.render({
        elem: '#divided'
        //,theme: '#393D49'
//graduation
    });
    laydate.render({
        elem: '#imyear'
        ,type: 'year'
        ,min: '1950-1-1'
        ,max: '2018-12-31'
        //,theme: '#393D49'
        ,done: function(value, date, endDate){
            var date = new Date();
            var nowyear = date .getFullYear();
            $('#age').val(nowyear - value);
            console.log(value); //得到日期生成的值，如：2017-08-18
            console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
            console.log(endDate); //得结束的日期时间对象，开启范围选择（range: true）才会返回。对象成员同上。
        }
    });



    laydate.render({
        elem: '#imyearmd'
        //,theme: '#393D49'
        ,done: function(value, date, endDate){
            var date = new Date();
            var nowyear = date .getFullYear();
            var returnyear = value.substr(0,4);
            $('#age').val(nowyear - parseInt(returnyear));
            console.log(value); //得到日期生成的值，如：2017-08-18
            console.log(value.substr(0,4)); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
            console.log(endDate); //得结束的日期时间对象，开启范围选择（range: true）才会返回。对象成员同上。
        }
    });

    laydate.render({
        elem: '#graduation'
        //,theme: '#393D49'
//
    });

});


