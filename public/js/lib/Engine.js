var TowerDefense = TowerDefense || {};

TowerDefense.Engine = (function(exports) {
    'use strict';

    function Engine(canvas) {
        this.canvas = canvas;

        this.fpsCounter = new exports.TowerDefense.Fps();

        this.canvas.register(new exports.TowerDefense.UserInterface.Map());
        this.canvas.register(new exports.TowerDefense.UserInterface.Fps(this.fpsCounter));
    }

    Engine.prototype.start = function() {
        this.loop();
    };

    Engine.prototype.loop = function(time) {
        this.fpsCounter.update(time);

        this.canvas.draw();

        requestAnimationFrame(this.loop.bind(this))
    };

    return Engine;
}(window));
