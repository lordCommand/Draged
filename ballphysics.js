function updateBall(kin, ball, dd) {
	var canvas = kin.getCanvas();

	// physics variables
	var gravity = 20; // px / second^2
	var speedIncrementFromGravityEachFrame = gravity * kin.getTimeInterval() / 1000;
	var collisionDamper = 0.2; // 20% energy loss
	var floorFriction = 5; // px / second^2
	var floorFrictionSpeedReduction = floorFriction * kin.getTimeInterval() / 1000; 

	if(dd.isDragging) {
		var touchPos = kin.getTouchPos();

		if(touchPos !== null) {
			var touchX = touchPos.x;
			var touchY = touchPos.y;

			var c = 0.06 * kin.getTimeInterval();
			ball.vx = c * (touchX - dd.lastTouchX);
			ball.vy = c * (touchY - dd.lastTouchY);
			dd.lastTouchX = touchX;
			dd.lastTouchY = touchY;
			ball.x = touchX;
			ball.y = touchY;
		}
	}
	else {
		// gravity
		ball.vy += speedIncrementFromGravityEachFrame;
		ball.y += ball.vy;
		ball.x += ball.vx;


		// ceiling condition
		if(ball.y < ball.radius) {
			ball.y = ball.radius;
			ball.vy *= -1;
			ball.vy *= (1 - collisionDamper);
		}

		// floor condition
		if(ball.y > (canvas.height - ball.radius)) {
			ball.y = canvas.height - ball.radius;
			ball.vy *= -1;
			ball.vy *= (1 - collisionDamper);
		}

		// floor friction
		if(ball.y == canvas.height - ball.radius) {
			if(ball.vx > 0.1) {
				ball.vx -= floorFrictionSpeedReduction;
			}
			else if(ball.vx < -0.1) {
				ball.vx += floorFrictionSpeedReduction;
			}
			else {
				ball.vx = 0;
			}
		}

		// right wall condition
		if(ball.x > (canvas.width - ball.radius)) {
			ball.x = canvas.width - ball.radius;
			ball.vx *= -1;
			ball.vx *= (1 - collisionDamper);
		}

		// left wall condition
		if(ball.x < (ball.radius)) {
			ball.x = ball.radius;
			ball.vx *= -1;
			ball.vx *= (1 - collisionDamper);
		}
	}
}