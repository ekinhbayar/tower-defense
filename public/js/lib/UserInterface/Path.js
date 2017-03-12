var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Path = (function() {
    'use strict';

    function Path(x, y) {
        this.x = x;
        this.y = y;

        this.loaded = false;

        this.tile = new Image();

        this.tile.addEventListener('load', () => {
            this.loaded = true;
        });

        this.tile.src = 'img/road.jpg';
    }

    Path.prototype.draw = function(canvas) {
        if (!this.loaded) {
            return;
        }

        canvas.context.drawImage(this.tile, (this.x + canvas.x) * canvas.scale.x, (this.y + canvas.y) * canvas.scale.y, 20 * canvas.scale.x, 20 * canvas.scale.y);
    };

    return Path;
}());
