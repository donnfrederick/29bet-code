var PGGame = /** @class */ (function () {
    function PGGame() {
        this.currentMoney = 0;

        this.init();
    }
    PGGame.prototype.init = function () {
        const xhr = new XMLHttpRequest();
        const csrfToken = $('meta[name=csrf-token]').attr('content');

        xhr.open("GET", "/api/pg/refresh/balance");

        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Authorization', 'Bearer ' + csrfToken);

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);

                $('#money').html(response.balance);
                $('#money').attr('data-current-balance', response.balance);
                setTimeout(() => {
                    this.init();
                }, 5000);
            } else {
                $('#modal_please_login').addClass('md-show');
            }
        };

        xhr.send();
    };
    return PGGame;
}());

window.onload = function() {
    new PGGame();
}


const toggleButton = document.getElementById('fullScreenGames');
const fullscreenDiv = document.getElementById('fullscreenDiv');

toggleButton.addEventListener('touchstart', () => {
    if (isFullscreen()) {
        exitFullscreen();
    } else {
        enterFullscreen(fullscreenDiv);
    }
});
function isFullscreen() {
    return (
        document.fullscreenElement ||
        document.webkitFullscreenElement ||
        document.mozFullScreenElement ||
        document.msFullscreenElement
    );
}
function enterFullscreen(element) {
    if (element.requestFullscreen) {
        element.requestFullscreen();
    } else if (element.webkitRequestFullscreen) {
        element.webkitRequestFullscreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.msRequestFullscreen) {
        element.msRequestFullscreen();
    }
}
function exitFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
}
