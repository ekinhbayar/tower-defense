var TowerDefense = TowerDefense || {};

TowerDefense.Fps = (function() {
    'use strict';

    function Fps() {
        this.lastUpdate = +new Date();
        this.lastTime   = +new Date();
        this.fps        = 0;
    }

    Fps.prototype.update = function(time) {
        if (typeof time === 'undefined' || Math.abs(time - this.lastUpdate) < 500) {
            this.lastTime = time;

            return;
        }

        this.fps = 1000 / (time - this.lastTime);

        this.lastTime = time;
        this.lastUpdate = time;
    };

    Fps.prototype.get = function() {
        return this.fps;
    };

    return Fps;
}());
