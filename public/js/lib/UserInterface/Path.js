var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Path = (function() {
    'use strict';

    function Path(x, y) {
        this.x = x;
        this.y = y;
    }

    Path.prototype.draw = function(canvasContext) {
        canvasContext.fillStyle = 'gray';

        canvasContext.fillRect(this.x, this.y, 20, 20);
    };

    return Path;
}());
