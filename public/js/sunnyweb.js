<script>

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

        if(number === '603799'){imgToSwap.src = "./bank-iran/meli.png";}
        if(number === '589210'){imgToSwap.src = "./bank-iran/sepah.png";}
        if(number === '627961'){imgToSwap.src = "./bank-iran/sanatmadan.png";}
        if(number === '603770'){imgToSwap.src = "./bank-iran/keshavarsi.png";}
        if(number === '628023'){imgToSwap.src = "./bank-iran/maskan.png";}
        if(number === '627760'){imgToSwap.src = "./bank-iran/postbank.png";}
        if(number === '502908'){imgToSwap.src = "./bank-iran/tosehe.png";}
        if(number === '627412'){imgToSwap.src = "./bank-iran/eghtesad.png";}
        if(number === '622106'){imgToSwap.src = "./bank-iran/parsian.png";}
        if(number === '502229'){imgToSwap.src = "./bank-iran/pasargad.png";}
        if(number === '627488'){imgToSwap.src = "./bank-iran/karafarin.png";}
        if(number === '621986'){imgToSwap.src = "./bank-iran/saman.png";}
        if(number === '639346'){imgToSwap.src = "./bank-iran/sina.png";}
        if(number === '639607'){imgToSwap.src = "./bank-iran/sarmaye.png";}
        if(number === '502806'){imgToSwap.src = "./bank-iran/shahr.png";}
        if(number === '502938'){imgToSwap.src = "./bank-iran/day.png";}
        if(number === '603769'){imgToSwap.src = "./bank-iran/saderat.png";}
        if(number === '610433'){imgToSwap.src = "./bank-iran/mellat.png";}
        if(number === '627353'){imgToSwap.src = "./bank-iran/tejarat.png";}
        if(number === '589463'){imgToSwap.src = "./bank-iran/refah.png";}
        if(number === '627381'){imgToSwap.src = "./bank-iran/ansar.png";}
        if(number === '639370'){imgToSwap.src = "./bank-iran/mehreqtesad.png";}
        if(number === '639599'){imgToSwap.src = "./bank-iran/ghavamin.png";}
        if(number === '504172'){imgToSwap.src = "./bank-iran/resalat.png";}
    }
</script>