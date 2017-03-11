var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Player = (function() {
    'use strict';

    function Player(authenticatedPlayer, player) {
        this.authenticatedPlayer = authenticatedPlayer;

        this.id   = player.id;
        this.name = player.name;
        this.x    = player.x;
        this.y    = player.y;
    }

    Player.prototype.draw = function(canvasContext, canvas) {
        if (this.id === this.authenticatedPlayer.id) {
            canvasContext.fillStyle = 'green';
        } else {
            canvasContext.fillStyle = 'yellow';
        }

        if (this.x === 0 || this.x === canvas.width) {
            canvasContext.fillRect(this.x, this.y, 5, 20);
        } else {
            canvasContext.fillRect(this.x, this.y, 20, 5);
        }
    };

    return Player;
}());
