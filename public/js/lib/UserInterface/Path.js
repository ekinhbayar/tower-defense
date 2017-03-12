var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Path = (function() {
    'use strict';

    function Path(x, y) {
        this.x = x;
        this.y = y;
    }

    Path.prototype.draw = function(canvas) {
        const tile = new Image();

        tile.addEventListener('load', () => {
            canvas.context.drawImage(tile, (this.x + canvas.x) * canvas.scale.x, (this.y + canvas.y) * canvas.scale.y, 20 * canvas.scale.x, 20 * canvas.scale.y);
        });

        tile.src = 'img/road.jpg';
    };

    return Path;
}());
