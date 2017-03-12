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

    Enemy.prototype.draw = function(canvas) {
        canvas.context.fillStyle = '#ff3300';

        canvas.context.fillRect(this.x, this.y, 5 * canvas.scale.x, 5 * canvas.scale.y);
    };

    return Enemy;
}());
