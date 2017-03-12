var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Path = (function() {
    'use strict';

    function Path(x, y) {
        this.x = x;
        this.y = y;
    }

    Path.prototype.draw = function(scale, canvasContext) {
        canvasContext.fillStyle = 'gray';

        canvasContext.fillRect(this.x * scale.x, this.y * scale.y, 20 * scale.x, 20 * scale.y);
    };

    return Path;
}());
