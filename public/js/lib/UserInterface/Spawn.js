var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Spawn = (function() {
    'use strict';

    function Spawn(x, y) {
        this.x = x;
        this.y = y;
    }

    Spawn.prototype.draw = function(canvasContext, canvas) {
        canvasContext.fillStyle = 'red';

        if (this.x === 0 || this.x === canvas.width) {
            canvasContext.fillRect(this.x, this.y, 5, 20);
        } else {
            canvasContext.fillRect(this.x, this.y, 20, 5);
        }
    };

    return Spawn;
}());
