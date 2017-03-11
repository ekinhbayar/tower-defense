var TowerDefense = TowerDefense || {};

TowerDefense.Fps = (function() {
    'use strict';

    function Fps() {
        this.lastTime = +new Date();
        this.fps      = 0;
    }

    Fps.prototype.update = function(time) {
        if (typeof time === 'undefined') {
            return;
        }

        this.fps = 1000 / (time - this.lastTime);

        this.lastTime = time;
    };

    Fps.prototype.get = function() {
        return this.fps;
    };

    return Fps;
}());
