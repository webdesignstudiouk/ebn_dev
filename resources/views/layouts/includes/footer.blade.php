<footer class='main-footer'>
    <div class='footer-inner'>
        <div class='footer-text'>
            © 2017 <strong>Energy Buyers Network</strong>
        </div>
        <div class='go-up'>
            <a class='fa-angle-up' href='#' rel='go-top' style='font-style: italic'></a>
        </div>
    </div>
</footer>

</div>

<div class="fixed" id="chat">
    <div class="chat-inner ps-container" style="max-height: 1087px;">
        <h2 class="chat-header"><a class="chat-close" id="closChat_button"><i
                        class="fa-plus-circle rotate-45deg"></i></a> Notifications <span
                    class="badge badge-success is-hidden">0</span></h2>

        <div class="chat-group">
            @if (session()->has('flash_notification.message'))
                <div class="alert alert-{{ session('flash_notification.level') }}">
                    {!! session('flash_notification.message') !!}
                </div>
            @endif
        </div>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; right: 2px;">
            <div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
        </div>
    </div>
</div>

</div>

<script src='{{url("js/app.js")}}'></script>
<script src='{{url("js/ajax.js")}}'></script>
<script src="//cdn.ckeditor.com/4.7.1/basic/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src='{{url("js/datetime_picker.js")}}'></script>
<script src='{{url("js/pace.js")}}'></script>
<script src='{{url("js/jquery.sticky.js")}}'></script>
<script>
    if($('.supplier_and_product_info').length) {
        CKEDITOR.replace('supplier_and_product_info');
    }
    if($('.customer_service_and_billing').length) {
        CKEDITOR.replace('customer_service_and_billing');
    }
    if($('.renewal_cycle').length) {
        CKEDITOR.replace('renewal_cycle');
    }
    if($('.credit_and_restrictions').length) {
        CKEDITOR.replace('credit_and_restrictions');
    }
</script>

<script type="text/javascript">
    $(function () {
        $("input[type=date]").keydown(false);
        @if(isset($beginDate))
        if (document.getElementById("callbackBeginDate")) {
            $('#callbackBeginDate').datetimepicker({
                format: 'DD/MM/YYYY',
                defaultDate: new Date("{!!Carbon\Carbon::createFromFormat('Y-m-d', $beginDate)!!}")
            });

            $('#callbackBeginDate').on("dp.change", function (e) {
                window.location.href = '?beginDate=' + $('#callbackBeginDate').val() + '&endDate=' + $('#callbackEndDate').val();
            });
        }
        @endif
                @if(isset($beginDate))
        if (document.getElementById("callbackEndDate")) {
            $('#callbackEndDate').datetimepicker({
                format: 'DD/MM/YYYY',
                defaultDate: new Date("{!! Carbon\Carbon::createFromFormat('Y-m-d', $endDate) !!}")
            });

            $('#callbackEndDate').on("dp.change", function (e) {
                console.log($('#callbackEndDate').val());
                window.location.href = '?beginDate=' + $('#callbackBeginDate').val() + '&endDate=' + $('#callbackEndDate').val();
            });
        }
        @endif

        if (document.getElementById("verbalCED")) {
            $('#verbalCED').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        }

        if (document.getElementById("loaSent")) {
            $('#loaSent').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        }
    });
</script>
</body>
</html>