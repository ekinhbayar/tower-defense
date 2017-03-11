var TowerDefense = TowerDefense || {};
TowerDefense.Video = TowerDefense.Video || {};

TowerDefense.Video.Canvas = (function(exports) {
    'use strict';

    function Canvas() {
        this.drawables = [];

        this.canvas  = document.getElementById('game');
        this.context = this.canvas.getContext('2d');

        exports.addEventListener('resize', this.resize.bind(this), false);

        this.resize();
    }

    Canvas.prototype.resize = function() {
        this.canvas.width  = exports.innerWidth;
        this.canvas.height = exports.innerHeight;
    };

    Canvas.prototype.register = function(drawable) {
        this.drawables.push(drawable);
    };

    Canvas.prototype.draw = function() {
        this.clear();

        this.drawables.forEach((drawable) => {
            drawable.draw(this.context, this.canvas);
        })
    };

    Canvas.prototype.clear = function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    };

    return Canvas;
}(window));
