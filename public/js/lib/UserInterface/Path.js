var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Path = (function() {
    'use strict';

    function Path(x, y) {
        this.x = x;
        this.y = y;
    }

    Path.prototype.draw = function(canvas) {
        canvas.context.fillStyle = 'gray';

        canvas.context.fillRect((this.x + canvas.x) * canvas.scale.x, (this.y + canvas.y) * canvas.scale.y, 20 * canvas.scale.x, 20 * canvas.scale.y);
    };

    return Path;
}());
