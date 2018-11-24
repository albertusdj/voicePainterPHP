<script>
  const canvas = document.querySelector('canvas');

canvas.width = 0.99 * window.innerWidth;
canvas.height = 0.8 * window.innerHeight;

const c = canvas.getContext('2d');
let currentSize = 30;

const red = 'rgba(255, 0, 0, 0.5)';
const green = 'rgba(0, 255, 0, 0.5)';
const blue = 'rgba(0, 0, 255, 0.5)';

let currentCircleColor = blue;
let currentRectangleColor = red;
let currentTriangleColor = green;

const circleArray = [];
const rectangleArray = [];
const triangleArray = [];

function Circle(x, y, dx, dy, radius, color) {
  this.x = x;
  this.y = y;
  this.dx = dx;
  this.dy = dy;
  this.radius = radius;
  this.color = color;

  this.draw = () => {
    c.beginPath();
    c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
    c.strokeStyle = this.color;
    c.stroke();
    c.fillStyle = this.color;
    c.fill();
  }

  this.update = () => {
    if (this.x + this.radius > canvas.width || this.x - this.radius < 0) {
      this.dx = -this.dx;
    }

    if (this.y + this.radius > canvas.height || this.y - this.radius < 0) {
      this.dy = -this.dy;
    }

    this.x += this.dx;
    this.y += this.dy;

    this.draw();
  }
}

function Rectangle(x, y, dx, dy, size, color) {
  this.x = x;
  this.y = y;
  this.dx = dx;
  this.dy = dy;
  this.size = size;
  this.color = color;

  this.draw = () => {
    c.beginPath();
    c.moveTo(this.x, this.y);
    c.lineTo(this.x + this.size, this.y);
    c.lineTo(this.x + this.size, this.y + this.size);
    c.lineTo(this.x, this.y + this.size);
    c.lineTo(this.x, this.y);
    c.strokeStyle = this.color;
    c.stroke();
    c.fillStyle = this.color;
    c.fill();
  }

  this.update = () => {
    if (this.x + this.size > canvas.width || this.x < 0) {
      this.dx = -this.dx;
    }

    if (this.y + this.size > canvas.height || this.y < 0) {
      this.dy = -this.dy;
    }

    this.x += this.dx;
    this.y += this.dy;

    this.draw();
  }
}

function Triangle(x, y, dx, dy, size, color) {
  this.x = x;
  this.y = y;
  this.dx = dx;
  this.dy = dy;
  this.size = size;
  this.color = color;

  this.draw = () => {
    c.beginPath();
    c.moveTo(this.x, this.y + this.size);
    c.lineTo(this.x + this.size/2, this.y);
    c.lineTo(this.x + this.size, this.y + this.size);
    c.lineTo(this.x, this.y + this.size);
    c.strokeStyle = this.color;
    c.stroke();
    c.fillStyle = this.color;
    c.fill();
  }

  this.update = () => {
    if (this.x + this.size > canvas.width || this.x < 0) {
      this.dx = -this.dx;
    }

    if (this.y + this.size > canvas.height || this.y < 0) {
      this.dy = -this.dy;
    }

    this.x += this.dx;
    this.y += this.dy;

    this.draw();
  }
}

function addCircle() {
  const radius = currentSize/2;

  const x = Math.random() * (canvas.width - radius * 2) + radius;
  const y = Math.random() * (canvas.height - radius * 2) + radius;

  const dx = (Math.random() - 0.5) * 5;
  const dy = (Math.random() - 0.5) * 5;

  const color = currentCircleColor;

  circleArray.push(new Circle(x, y, dx, dy, radius, color));
}

function addRectangle() {
  const size = currentSize;

  const x = Math.random() * (canvas.width - size * 2) + size;
  const y = Math.random() * (canvas.height - size * 2) + size;

  const dx = (Math.random() - 0.5) * 5;
  const dy = (Math.random() - 0.5) * 5;

  const color = currentRectangleColor;

  rectangleArray.push(new Rectangle(x, y, dx, dy, size, color));
}

function addTriangle() {
  const size = currentSize;

  const x = Math.random() * (canvas.width - size * 2) + size;
  const y = Math.random() * (canvas.height - size * 2) + size;

  const dx = (Math.random() - 0.5) * 5;
  const dy = (Math.random() - 0.5) * 5;

  const color = currentTriangleColor;

  triangleArray.push(new Triangle(x, y, dx, dy, size, color));
}

function fillCircle(color) {
  for (let i=0; i < circleArray.length; i++) {
    circleArray[i].colorFill = color;
  }
}

function fillRectangle(color) {
  for (let i=0; i < rectangleArray.length; i++) {
    rectangleArray[i].colorFill = color;
  }
}

function fillTriangle(color) {
  for (let i=0; i< triangleArray.length; i++) {
    triangleArray[i].colorFill = color;
  }
}

function zoomIn() {
  if (currentSize < 120) {
    currentSize += 30;

    for(let i=0; i<circleArray.length; i++) {
      circleArray[i].radius = currentSize/2;
    }

    for(let i=0; i<rectangleArray.length; i++) {
      rectangleArray[i].size = currentSize;
    }

    for(let i=0; i<triangleArray.length; i++) {
      triangleArray[i].size = currentSize;
    }
  }
}

function zoomOut() {
  if (currentSize > 30) {
    currentSize -= 30;

    for(let i=0; i<circleArray.length; i++) {
      circleArray[i].radius = currentSize/2;
    }

    for(let i=0; i<rectangleArray.length; i++) {
      rectangleArray[i].size = currentSize;
    }

    for(let i=0; i<triangleArray.length; i++) {
      triangleArray[i].size = currentSize;
    }
  }
}

function eraseCircle() {
  circleArray = [];
}

function eraseRectangle() {
  rectangleArray = [];
}

function eraseTriangle() {
  triangleArray = [];
}

addCircle();
addCircle();
addCircle();

addRectangle();
addRectangle();
addRectangle();

addTriangle();
addTriangle();
addTriangle();

function animate() {
  requestAnimationFrame(animate);

  c.clearRect(0, 0, canvas.width, canvas.height);

  for(let i=0; i < circleArray.length; i++) {
    circleArray[i].update();
  }

  for(let i=0; i< rectangleArray.length; i++) {
    rectangleArray[i].update();
  }

  for(let i=0; i< triangleArray.length; i++) {
    triangleArray[i].update();
  }    
}

animate();
</script>