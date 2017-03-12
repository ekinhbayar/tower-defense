var TowerDefense = TowerDefense || {};
TowerDefense.Video = TowerDefense.Video || {};

TowerDefense.Video.Canvas = (function(exports) {
    'use strict';

    const MAP_WIDTH  = 1200;
    const MAP_HEIGHT = 800;

    // MAPS ARE 1200x800
    function Canvas() {
        this.drawables = [];

        this.scale = {x: 1, y: 1};
        this.x    = 0;
        this.y    = 0;

        this.dragging = {
            enabled: false,
            start: {
                x: 0,
                y: 0
            }
        };

        this.canvas  = document.getElementById('game');
        this.context = this.canvas.getContext('2d');

        exports.addEventListener('resize', this.resize.bind(this), false);
        document.addEventListener('mousewheel', this.scroll.bind(this), false);
        //document.getElementById('game').addEventListener('dragstart', this.drag.bind(this), false);
        document.addEventListener('mousedown', this.mouseDown.bind(this), false);
        document.addEventListener('mouseup', this.mouseUp.bind(this), false);

        this.resize();
    }

    Canvas.prototype.resize = function() {
        this.canvas.width  = exports.innerWidth;
        this.canvas.height = exports.innerHeight;

        this.rescale();
    };

    Canvas.prototype.scroll = function(e) {
        e.stopPropagation();
        e.preventDefault();

        if (e.deltaY === 100) {
            this.scale.x /= 1.5;
            this.scale.y /= 1.5;
        } else if (e.deltaY === -100) {
            this.scale.x *= 1.5;
            this.scale.y *= 1.5;
        }
    };

    Canvas.prototype.mouseDown = function(e) {
        this.dragging = {
            enabled: true,
            x: e.clientX,
            y: e.clientY
        };
    };

    Canvas.prototype.mouseUp = function(e) {
        if (Math.abs(e.clientX - this.dragging.x) > 10 || Math.abs(e.clientY - this.dragging.y) > 10) {
            this.x = e.clientX - this.dragging.x;
            this.y = e.clientY - this.dragging.y;

            if (this.x < 0) {
                this.x = 0;
            }

            if (this.y < 0) {
                this.y = 0;
            }
        }

        this.dragging = {
            enabled: false,
            x: 0,
            y: 0
        };
    };

    Canvas.prototype.rescale = function() {
        this.scale.x = this.canvas.width / MAP_WIDTH;
        this.scale.y = this.canvas.height / MAP_HEIGHT;
    };

    Canvas.prototype.register = function(drawable) {
        this.drawables.push(drawable);
    };

    Canvas.prototype.draw = function() {
        this.clear();

        console.log({
            scale: this.scale,
            x: this.x,
            y: this.y,
            canvasContext: this.context,
            canvas: this.canvas
        });

        this.drawables.forEach((drawable) => {
            drawable.draw({
                scale: this.scale,
                x: this.x,
                y: this.y,
                context: this.context,
                element: this.canvas
            });
        })
    };

    Canvas.prototype.clear = function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    };

    return Canvas;
}(window));
