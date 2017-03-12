var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Spawn = (function() {
    'use strict';

    function Spawn(x, y) {
        this.x = x;
        this.y = y;
    }

    Spawn.prototype.draw = function(scale, canvasContext, canvas) {
        canvasContext.fillStyle = 'red';

        if (this.x === 0 || this.x === canvas.width) {
            canvasContext.fillRect(this.x * scale.x, this.y * scale.y, 5 * scale.x, 20 * scale.y);
        } else {
            canvasContext.fillRect(this.x * scale.x, this.y * scale.y, 20 * scale.x, 5 * scale.y);
        }
    };

    return Spawn;
}());
