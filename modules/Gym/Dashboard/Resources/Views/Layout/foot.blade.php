<script data-cfasync="false" src="{{asset('assets/plugins/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
<script src="{{asset('assets/js/vendor.min.js')}}" type="20af472fe74ea09bb7a3acf9-text/javascript"></script>
<script src="{{asset('assets/js/app.min.js')}}" type="20af472fe74ea09bb7a3acf9-text/javascript"></script>
<script src="{{asset('assets/plugins/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="e7ef52109ce79714353581f4-|49" defer=""></script>
<script src="{{asset('assets/plugins/highlight.js/highlight.min.js')}}" type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap-table/dist/bootstrap-table.min.js')}}" type="5cd566d4c9167be52e0a161f-text/javascript"></script>
<script src="{{asset('assets/plugins/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="5cd566d4c9167be52e0a161f-|49" defer=""></script>
<script src="{{asset('assets/plugins/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="e400dfa484518cb300ca4496-|49" defer=""></script>
<script src="{{asset('assets/plugins/highlight.js/highlight.min.js')}}" type="baefc97b203bd00fdfb95390-text/javascript"></script>
<script src="{{asset('assets/plugins/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="baefc97b203bd00fdfb95390-|49" defer=""></script>
<script src="{{asset('assets/plugins/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="20af472fe74ea09bb7a3acf9-|49" defer=""></script>
<script src="{{asset('/assets/plugins/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="c5c0adc4f4089ee7793a577e-|49" defer=""></script>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/persianDatePicker/js/persianDatepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/bankcardcheckiran/sunnyweb.js')}}"></script>
<script src="{{asset('assets/plugins/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="c5c0adc4f4089ee7793a577e-|49" defer=""></script>
<script src="{{asset('assets/js/beacon.min.js')}}"></script>
<script src="{{asset('assets/material-rtl-time-picker/mdtimepicker.js')}}"></script>
<script src="{{asset('/assets/js/select2.min.js')}}"></script>


<script>

    $('#datepicker').datepicker({
        autoclose: true
    });

    function sunnyweb_check_number() {
        var cardnumber = document.getElementById("cardnumber").value;
        document.getElementById('card_er').style.display='none';
        function validateCard(code) {
            var L = code.length;
            if (L < 16 || parseInt(code.substr(1, 10), 10) == 0 || parseInt(code.substr(10, 6), 10) == 0) return false;
            var c = parseInt(code.substr(15, 1), 10);
            var s = 0;
            var k, d;
            for (var i = 0; i < 16; i++) {
                k = (i % 2 == 0) ? 2 : 1;
                d = parseInt(code.substr(i, 1), 10) * k;
                s += (d > 9) ? d - 9 : d;
            }
            return ((s % 10) == 0);
        }
        if (validateCard(cardnumber) === false) document.getElementById('card_er').style.display='block';
        var number = cardnumber.substring(6,-16);
        var imgToSwap = document.getElementById("img0");
        if(number === '603799'){imgToSwap.src = "{{asset('./assets/img/bank-iran/meli.png')}}";}
        if(number === '589210'){imgToSwap.src = "{{asset('./assets/img/bank-iran/sepah.png')}}";}
        if(number === '627961'){imgToSwap.src = "{{asset('./assets/img/bank-iran/sanatmadan.png')}}";}
        if(number === '603770'){imgToSwap.src = "{{asset('./assets/img/bank-iran/keshavarsi.png')}}";}
        if(number === '628023'){imgToSwap.src = "{{asset('./assets/img/bank-iran/maskan.png')}}";}
        if(number === '627760'){imgToSwap.src = "{{asset('./assets/img/bank-iran/postbank.png')}}";}
        if(number === '502908'){imgToSwap.src = "{{asset('./assets/img/bank-iran/tosehe.png')}}";}
        if(number === '627412'){imgToSwap.src = "{{asset('./assets/img/bank-iran/eghtesad.png')}}";}
        if(number === '622106'){imgToSwap.src = "{{asset('./assets/img/bank-iran/parsian.png')}}";}
        if(number === '502229'){imgToSwap.src = "{{asset('./assets/img/bank-iran/pasargad.png')}}";}
        if(number === '627488'){imgToSwap.src = "{{asset('./assets/img/bank-iran/karafarin.png')}}";}
        if(number === '621986'){imgToSwap.src = "{{asset('./assets/img/bank-iran/saman.png')}}";}
        if(number === '639346'){imgToSwap.src = "{{asset('./assets/img/bank-iran/sina.png')}}";}
        if(number === '639607'){imgToSwap.src = "{{asset('./assets/img/bank-iran/sarmaye.png')}}";}
        if(number === '502806'){imgToSwap.src = "{{asset('./assets/img/bank-iran/shahr.png')}}";}
        if(number === '502938'){imgToSwap.src = "{{asset('./assets/img/bank-iran/day.png')}}";}
        if(number === '603769'){imgToSwap.src = "{{asset('./assets/img/bank-iran/saderat.png')}}";}
        if(number === '610433'){imgToSwap.src = "{{asset('./assets/img/bank-iran/mellat.png')}}";}
        if(number === '627353'){imgToSwap.src = "{{asset('./assets/img/bank-iran/tejarat.png')}}";}
        if(number === '589463'){imgToSwap.src = "{{asset('./assets/img/bank-iran/refah.png')}}";}
        if(number === '627381'){imgToSwap.src = "{{asset('./assets/img/bank-iran/ansar.png')}}";}
        if(number === '639370'){imgToSwap.src = "{{asset('./assets/img/bank-iran/mehreqtesad.png')}}";}
        if(number === '639599'){imgToSwap.src = "{{asset('./assets/img/bank-iran/ghavamin.png')}}";}
        if(number === '504172'){imgToSwap.src = "{{asset('./assets/img/bank-iran/resalat.png')}}";}
    }
</script>





{{--<script>--}}
{{--    $(function () {--}}
{{--        const urlParams = new URLSearchParams(window.location.search);--}}
{{--        let date = urlParams.get('date') ?? @json(session('date'));--}}
{{--        console.log(date);--}}
{{--        getServices(date);--}}
{{--        $("#date").persianDatepicker({--}}
{{--            formatDate: "YYYY-MM-DD",--}}
{{--            onSelect: () => {--}}
{{--                date = $("#date").attr("data-gdate");--}}
{{--                getServices(date);--}}
{{--                urlParams.set('date', date);--}}
{{--                window.history.pushState({}, '', `${location.pathname}?${urlParams.toString()}`);--}}
{{--            }--}}
{{--        });--}}

{{--        $(document).on("click",".service" ,function () {--}}
{{--            let date = $(this).data('date'),--}}
{{--                id = $(this).data('id');--}}
{{--            console.log(date,id);--}}

{{--            $.ajax({--}}
{{--                url: "{{ route("senses.getModal") }}",--}}
{{--                data: {date, id},--}}
{{--                success(data) {--}}
{{--                    $("#modalPosBooking .modal-content").html(data);--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    });--}}

{{--    function getServices(date) {--}}
{{--        $.ajax({--}}
{{--            url: "{{ route("senses.showServices") }}",--}}
{{--            data: {date},--}}
{{--            success(data) {--}}
{{--                $("#services").html(data);--}}
{{--            }--}}
{{--        })--}}
{{--    }--}}
{{--</script>--}}

@yield('js')
