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

    Player.prototype.draw = function(canvas) {
        if (this.id === this.authenticatedPlayer.id) {
            canvas.context.fillStyle = 'green';
        } else {
            canvas.context.fillStyle = 'yellow';
        }

        if (this.x === 0 || this.x === canvas.element.width) {
            canvas.context.fillRect((this.x + canvas.x) * canvas.scale.x, (this.y + canvas.y) * canvas.scale.y, 5 * canvas.scale.x, 20 * canvas.scale.y);
        } else {
            canvas.context.fillRect((this.x + canvas.x) * canvas.scale.x, (this.y + canvas.y) * canvas.scale.y, 20 * canvas.scale.x, 5 * canvas.scale.y);
        }
    };

    return Player;
}());
