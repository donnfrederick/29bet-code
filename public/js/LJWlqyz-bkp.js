const CslXL = {
    isMuted: false, msg: null, trId: null, btMTr: ["You have no chance to turn","Você não tem nenhuma chance de girar","你没有机会转身"], rS: [], pzs: ['0', '1', '3', '5', '8', '10', '100', '300', '300', '300', '500', '500', '500', '3000', '3000', '3000', '6000', '6000', '6000', 'iPhone 14', 'iPhone 14', 'iPhone 14'], sPn: function() {
        let xhr = new XMLHttpRequest, csrfToken=$("meta[name=csrf-token]").attr("content");
        xhr.open("GET", "/api/freespin/spin"), xhr.setRequestHeader("Content-Type","appication/json"), xhr.setRequestHeader("X-CSRF-TOKEN",csrfToken), xhr.setRequestHeader("Authorization","Bearer "+csrfToken), xhr.onload = () => {
            if(xhr.status >= 200 && xhr.status < 300){
                const response = JSON.parse(xhr.responseText);
                CslXL.trId = response.trId;
                response.available ? 0 == wheelSpinning && (
                    theWheel.animation.spins=10, theWheel.sAn(response.prb), wheelSpinning=!0
                ) : CslXL.gRs(0)
            } else console.log(new Error(xhr.statusText))
        }, xhr.send();
    }, aPz: function(e) {
        if (CslXL.trId != null) {
            let xhr = new XMLHttpRequest, csrfToken=$("meta[name=csrf-token]").attr("content");
            xhr.open("POST", "/api/freespin/win"), xhr.setRequestHeader("Content-Type","appication/json"), xhr.setRequestHeader("X-CSRF-TOKEN",csrfToken), xhr.setRequestHeader("Authorization","Bearer "+csrfToken), xhr.onload = () => {
                if(xhr.status >= 200 && xhr.status < 300){
                    CslXL.bSrv();
                    const rs = JSON.parse(xhr.responseText);
                    for (let i = 0;i < 32;i++) {
                        $('#confetti__wheel__win').append('<div class="confetti-piece"></div>');
                    }

                    if (e.text != 0) {
                        $('#confetti__wheel__win').fadeIn(200), $("#free_spin_win").text(e.text), $('.dsdsdsds').toggleClass('md-show', false), $(".md-result-wheel-bonus").addClass("md-show"), CslXL.rtW(), $('#money').html(rs.bal), $('#money').attr('data-current-balance', rs.bal), setTimeout(() => {
                            $('#confetti__wheel__win').fadeOut(200), $('#confetti__wheel__win').html(''), $(".md-result-wheel-bonus").removeClass('md-show')
                        }, 4000);
                    } else $('.dsdsdsds').toggleClass('md-show', false), $('.md-result-wheel-lose').addClass('md-show'), CslXL.rtW();

                    
                } else console.log(new Error(xhr.statusText))
            }, xhr.send(JSON.stringify({'win': parseInt(e.text), 'trId': CslXL.trId, 'code': e.code}));
        }
    }, hDGn: function() {
        $('#confetti__wheel__win').fadeOut(200), $('#confetti__wheel__win').html(''), $(".md-result-wheel-bonus").removeClass("md-show")
    }, sCF: function() {
        var e = document.getElementById("wheelNewInformationFaq");
        e.classList.contains("wheel__new__informations__card--visible") ? e.classList.remove("wheel__new__informations__card--visible") : e.classList.add("wheel__new__informations__card--visible")
    }, sCJ: function() {
        var e = document.getElementById("wheelNewInformationJackpot");
        e.classList.contains("wheel__new__informations__card--visible") ? e.classList.remove("wheel__new__informations__card--visible") : e.classList.add("wheel__new__informations__card--visible")
    }, sT: function(e, k) {
        $('.tab-wheel-bonus').removeClass('activer');
        $('.freespin_tab_' + k).addClass('activer');
        const t = document.getElementsByClassName("content-wheel-bonus");
        for (let e = 0; e < t.length; e++) t[e].classList.remove("active");
        const n = document.getElementById(e);
        n && n.classList.add("active")
    }, rtW: function() {
        theWheel.stAn(!1), theWheel.rotationAngle = theWheel.animation.propertyValue - 3600, document.getElementById("spin_button").className = "wheel__btn", wheelSpinning = !1
    }, pSd: function() {
        !CslXL.isMuted && (audio.pause(), audio.currentTime = 0, audio.play())
    }, gRs: function(m) {
        0==m&&("en"==$("#frm_brand").val()?CslXL.msg=CslXL.btMTr[0]:"pt"==$("#frm_brand").val()?CslXL.msg=CslXL.btMTr[1]:CslXL.msg=CslXL.btMTr[2],CslXL.SwRs());
    }, SwRs: function() {
        return iziToast.info({
            message: CslXL.msg,
            icon: "fa fa-info"
        })
    }, mkRdI: function (mn, mx) {
        mn = Math.ceil(mn);
        mx = Math.floor(mx);
        return Math.floor(Math.random() * (mx - mn + 1)) + mn;
    }, gDi: function(rcj) {
        $('.wheel__new__historic__value').html('');
        rcj.forEach((j) => {
            let g = j.win;

            const pr = document.querySelector('.wheel__new__historic__value');

            const d = document.createElement('div');
            d.classList.add('wheel__new__historic__item');

            const img = document.createElement('img');

            if (g == 0) {
                g = "29bet";
                d.classList.add('big-prize');
                img.setAttribute('src', 'https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png');
            } else if (g == "iPhone 14") {
                g = "iPhone14";
                d.classList.add('jackpot');
                img.setAttribute('src', 'https://cdn.29bet.com/assets/img/apple.png');
            } else {
                d.classList.add('prize');
                img.setAttribute('src', 'https://cdn.29bet.com/assets/img/all/components/wheel-bonus/money-ico.png');
            }

            const p = document.createElement('p');
            const nd = document.createTextNode(g);9
            p.appendChild(nd);
            d.appendChild(p);
            d.appendChild(img);

            pr.append(d);
        });
    }, bSrv: function() {
        var e = document.querySelector('.md-result-wheel-bonus');

        var observer = new MutationObserver(function (event) {
            if (!e.classList.contains('md-show')) {
                $('#confetti__wheel__win').fadeOut(200), $('#confetti__wheel__win').html('')
            }
        })

        observer.observe(e, {
            attributes: true,
            attributeFilter: ['class'],
            childList: false,
            characterData: false
        });
    }
};

let bg=new Image;bg.src=freespin.rouletteBG;let backgroundOpacity=1,theWheel=new Winwheel({outerRadius:216,innerRadius:75,textFontSize:24,textOrientation:"horizontal",textAlignment:"outer",numSegments:freespin.segments.length,textLineWidth:3,lineWidth:8,textFillStyle:"#fff0",rotationAngle:0,segments:freespin.segments,animation:{type:"spinToStop",duration:10,spins:3,callbackFinished:CslXL.aPz,callbackSound:CslXL.pSd,soundTrigger:"pin"},pins:{number:freespin.segments.length,fillStyle:"none",outerRadius:0}});bg.onload=function(){theWheel.draw=function(){null!==theWheel.ctx&&(theWheel.ctx.clearRect(0,0,theWheel.canvas.width,theWheel.canvas.height),function(){let e=theWheel.ctx;e.save();let t=theWheel.canvas.width/2,l=theWheel.canvas.height/2,n=theWheel.rotationAngle%360*Math.PI/180;e.save(),e.globalAlpha=backgroundOpacity,e.translate(t,l),e.rotate(n);let i=1.1*bg.width,f=1.1*bg.height,a=-i/2,h=-f/2;e.drawImage(bg,a,h,i,f),e.restore()}())},theWheel.draw()};let audio=new Audio("/sound/tick.mp3"),wheelPower=0,wheelSpinning=!1;

let sono = true;

$('.wheel__new--sound').click(function() {
    if (sono) {
        sono = false;
        CslXL.isMuted = true;
        $(this).find('img').attr('src', 'https://cdn.29bet.com/assets/img/all/components/wheel-bonus/sound-off.png');
    } else {
        sono = true;
        CslXL.isMuted = false;
        $(this).find('img').attr('src', 'https://cdn.29bet.com/assets/img/all/components/wheel-bonus/sound-on.png');
    }
});
