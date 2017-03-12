var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Enemy = (function() {
    'use strict';

    function Enemy(x, y) {
        this.x = x;
        this.y = y;
    }

    Enemy.prototype.update = function(x, y) {
        this.x += x;
        this.y += y;
    };

    Enemy.prototype.draw = function(scale, canvasContext) {
        canvasContext.fillStyle = '#ff3300';

        canvasContext.fillRect(this.x, this.y, 5, 5);
    };

    return Enemy;
}());
