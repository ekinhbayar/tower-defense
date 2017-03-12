var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Spawn = (function() {
    'use strict';

    function Spawn(x, y) {
        this.x = x;
        this.y = y;
    }

    Spawn.prototype.draw = function(canvas) {
        canvas.context.fillStyle = 'red';

        if (this.x === 0 || this.x === canvas.element.width) {
            canvas.context.fillRect(this.x * canvas.scale.x, this.y * canvas.scale.y, 5 * canvas.scale.x, 20 * canvas.scale.y);
        } else {
            canvas.context.fillRect(this.x * canvas.scale.x, this.y * canvas.scale.y, 20 * canvas.scale.x, 5 * canvas.scale.y);
        }
    };

    return Spawn;
}());
