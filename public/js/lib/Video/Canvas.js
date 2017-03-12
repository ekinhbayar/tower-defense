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
            started: false,
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
        document.addEventListener('mousedown', this.mouseDown.bind(this), false);
        document.addEventListener('mousemove', this.mouseMove.bind(this), false);
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
            started: true,
            enabled: false,
            x: e.clientX,
            y: e.clientY
        };
    };

    Canvas.prototype.mouseMove = function(e) {
        if (!this.dragging.started) {
            return;
        }

        if (!this.dragging.enabled && Math.abs(e.clientX - this.dragging.x) > 10 || Math.abs(e.clientY - this.dragging.y) > 10) {
            this.dragging.enabled = true;
        }

        if (!this.dragging.enabled) {
            return;
        }

        this.x = this.x + e.clientX - this.dragging.x;
        this.y = this.y + e.clientY - this.dragging.y;

        this.dragging.x = e.clientX;
        this.dragging.y = e.clientY;
    };

    Canvas.prototype.mouseUp = function() {
        this.dragging.started = false;
        this.dragging.enabled = false;
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
