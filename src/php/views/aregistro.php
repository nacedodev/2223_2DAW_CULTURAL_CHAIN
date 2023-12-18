<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Encrypted Password Reveal w/ GSAP</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <style>
  @font-face {
  font-family: "Geist Mono";
  src: url("https://assets.codepen.io/605876/GeistMonoVariableVF.ttf") format("truetype");
}

:root {
	--grid-offset: calc(50% + 80px);
	--color: hsl(0 0% 6%);
	--bg: hsl(0 0% 96%);
	--color-alpha: hsl(0 0% 60%);
	--selection: hsl(0 0% 80%);
	--bg-size: 180px;
	--grid-line: hsl(0 0% 80%);
	--input-bg: hsl(0 0% 100% / 0.2);
	--grid-accent: hsl(280 0% 10% / 0.1);
	--glint: white;
	--button-shade: 80%;
	--transition: 0.25s;
	--spark: 1.8s;
	--bg-button: #3E0900;
	--bg-back: #FCC34D;
}
:root:focus-within {
	--grid-accent: hsla(0, 0%, 10%, 0);
}

@media(prefers-color-scheme: dark) {
	:root {
		--button-shade: 30%;
		--glint: black;
		--grid-accent: hsla(0, 0%, 80%, 0);
		--selection: hsl(0 0% 20%);
		--color: hsl(0 0% 98%);
		--bg: #171726;
		--color-alpha: #6F7789;
		--grid-line: hsl(0, 0%, 16%);
		--input-bg: hsl(0 0% 0% / 0.2);
		--bg-button:#131723; 
		--bg-back: #6F7789;
	}
	:root:focus-within {
		--grid-accent: hsla(0, 0%, 80%, 0);
	}
}

@media(prefers-color-scheme: light) {
	:root {
		--button-shade: 30%;
		--glint: black;
		--grid-accent: hsla(0, 0%, 80%, 0);
		--selection: hsl(0 0% 20%);
		--color: #8a1500;
		--bg: #FFF5DD;
		--color-alpha: #3E0900;
		--grid-line: rgba(204, 172, 146, 0.5);
		--input-bg: hsl(0 0% 0% / 0.2);
		--bg-button: #3E0900;
		--bg-back: #FCC34D;
	}
	:root:focus-within {
		--grid-accent: hsla(0, 0%, 80%, 0);
	}
}

*,
*:after,
*:before {
	box-sizing: border-box;
}

img{
	display: block;
	margin:0 auto;
}

body {
	--active: 0;
	display: grid;
	place-items: center;
	min-height: 100vh;
	font-family:  'Geist Mono', sans-serif, system-ui;
	color: var(--color);
	background: var(--bg);
}

body::before {
	content: "";
	transition: background 0.2s;
	background:
		/*	How to create one square */
		linear-gradient(var(--grid-accent) 0 2px, transparent 2px calc(100% - 2px), var(--grid-accent) calc(100% - 2px)) calc((var(--grid-offset) - (var(--bg-size) * 2)) - 1px) calc((var(--grid-offset) - var(--bg-size)) - 1px) / calc(var(--bg-size) + 2px) calc(var(--bg-size) + 2px) no-repeat,
		linear-gradient(90deg, var(--grid-accent) 0 2px, transparent 2px calc(100% - 2px), var(--grid-accent) calc(100% - 2px)) calc((var(--grid-offset) - (var(--bg-size) * 2)) - 1px) calc((var(--grid-offset) - var(--bg-size)) - 1px) / calc(var(--bg-size) + 2px) calc(var(--bg-size) + 2px) no-repeat,
		linear-gradient(transparent calc(var(--bg-size) - 2px), var(--grid-line) calc(var(--bg-size) - 2px) var(--bg-size)) var(--grid-offset) var(--grid-offset) / 100% var(--bg-size),
		linear-gradient(90deg, transparent calc(var(--bg-size) - 2px), var(--grid-line) calc(var(--bg-size) - 2px) var(--bg-size)) var(--grid-offset) var(--grid-offset) / var(--bg-size) 100%, transparent;
/*	background: var(--bg);*/
	position: fixed;
	inset: 0;
	height: 100vh;
	width: 100vw;
	-webkit-mask: radial-gradient(circle at 0% 0%, hsl(0 0% 100% / 0.5), transparent);
}

input:focus{
	border-color: var(--color);
	color: var(--color);
}

#mail:focus-within label{
	color: var(--color);
}

#nombre:focus-within label{
	color: var(--color);
}

#pwd:focus-within button {
	color: var(--color);
}

#pwd:focus-within label{
	color: var(--color);
}

input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px var(--bg) inset !important;
    -webkit-text-fill-color: var(--color) !important;
}

input {
	font-family: "Geist Mono", monospace;
	font-size: 1.75rem;
	padding: 1rem 1rem;
  padding-right: 4rem;
	letter-spacing: 0.2ch;
	border-radius: 6px;
	color: var(--color-alpha);
	border-color: var(--color-alpha);
	border-style: solid;
	background: var(--input-bg);
	outline: none;
	width: 100%;
	transition: border-color 0.2s, color 0.2s
}

#email{
	padding-right: 0;
}

label {
	display: block;
	margin-bottom: 5px;
	color: var(--color-alpha);
	letter-spacing: 0.2ch;
	transition: color 0.2s;
}

.form-group {
	position: relative;
	width: 100%;
}

form{
	width: 480px;
}

input{
	margin-bottom: 40px;
}

.eye circle:nth-of-type(2) {
	fill: var(--glint);
}

#pwd > button {
	padding: 0;
	display: grid;
	place-items: center;
	height: 18%;
	aspect-ratio: 1;
	border-radius: 12px;
	border: 0;
	background: linear-gradient(hsl(0 0% var(--button-shade) / calc(var(--active, 0) * 0.5)), hsl(0 0% var(--button-shade) / calc(var(--active, 0) * 0.5))) padding-box;
	border: 6px solid transparent;
	transition: background 0.125s;
	color: var(--color-alpha);
	position: absolute;
	right: -3.5px;
	z-index: 2;
	top: 71.2%;
	cursor: pointer;
	translate: 0 -50%;
	outline: 0;
	padding: 10px;
}

@media(prefers-color-scheme: dark) {
	#send{
		--bg:#131723; 
	}
}

@media(prefers-color-scheme: light) {
	#send{
		--bg:#3E0900; 
	}
}

#send{
	
		--cut: 0.1em;
		--active: 0;
		background: var(--bg);
		font-size: 1.2rem;
		filter: drop-shadow(0 0 0.2em);
		font-weight: 500;
		border: 0;
		cursor: pointer;
		display: block;
		margin: 0 auto;
		padding: 0.9em 1.3em;
		display: flex;
		align-items: center;
		gap: 0.25em;
		white-space: nowrap;
		border-radius: 15px;
		position: relative;
		box-shadow:
			0 0.05em 0 0 hsl(260 calc(0 * 97%) calc((0 * 50%) + 30%)) inset,
			0 -0.05em 0 0 hsl(260 calc(0 * 97%) calc(0 * 60%)) inset;
		transition: box-shadow var(--transition), scale var(--transition), background var(--transition);
		scale: calc(1 + (var(--active) * 0.1));
}

#send:active {
	scale: 1;
  }

  .sparkle path {
	color: hsl(0 0% calc((var(--active, 0) * 70%) + var(--base)));
	transform-box: fill-box;
	transform-origin: center;
	fill: currentColor;
	stroke: currentColor;
	animation-delay: calc((var(--transition) * 1.5) + (var(--delay) * 1s));
	animation-duration: 0.6s;
	transition: color var(--transition);
}

#send:is(:hover, :focus-visible) path {
	animation-name: bounce;
}

@keyframes bounce {
	35%, 65% {
		scale: var(--scale);
	}
}
.sparkle path:nth-of-type(1) {
	--scale: 0.5;
	--delay: 0.1;
	--base: 40%;
}

.sparkle path:nth-of-type(2) {
	--scale: 1.5;
	--delay: 0.2;
	--base: 20%;
}

.sparkle path:nth-of-type(3) {
	--scale: 2.5;
	--delay: 0.35;
	--base: 30%;
}


#send:before {
	content: "";
	position: absolute;
	inset: -0.25em;
	z-index: -1;
	border-radius: 15px;
	opacity: var(--active, 0);
	transition: opacity var(--transition);
}

.spark {
	position: absolute;
	inset: 0;
	border-radius: 15px;
	rotate: 0deg;
	overflow: hidden;
	mask: linear-gradient(white, transparent 60%);
	animation: flip calc(var(--spark) * 2) infinite steps(2, end);
}

@keyframes flip {
	to {
		rotate: 360deg;
	}
}

.spark:before {
	content: "";
	position: absolute;
	width: 200%;
	aspect-ratio: 1;
	top: 0%;
	left: 50%;
	z-index: -1;
	translate: -50% -15%;
	rotate: 0;
	transform: rotate(-90deg);
	opacity: calc((var(--active)) + 0.4);
	background: conic-gradient(
		from 0deg,
		transparent 0 340deg,
		white 360deg
	);
	transition: opacity var(--transition);
	animation: rotate var(--spark) linear infinite both;
}

.spark:after {
	content: "";
	position: absolute;
	inset: var(--cut);
	border-radius: 15px;
}

.backdrop {
	position: absolute;
	inset: var(--cut);
	background: var(--bg);
	border-radius: 15px;
	transition: background var(--transition);
}

@keyframes rotate {
	to {
		transform: rotate(90deg);
	}
}

#send:is(:hover, :focus-visible) {
	--active: 0.4;
	--play-state: running;
}

.text {
	translate: 2% -6%;
	letter-spacing: 0.01ch;
	background: linear-gradient(90deg, hsl(0 0% calc((0.3 * 100%) + 65%)), hsl(0 0% calc((0.1 * 100%) + 26%)));
	-webkit-background-clip: text;
	color: transparent;
	transition: background var(--transition);
}

#send:before {
	content: "";
	position: absolute;
	inset: -0.25em;
	z-index: -1;
	border-radius: 15px;
	opacity: var(--active, 0);
	transition: opacity var(--transition);
}

input::-moz-selection {
	background: var(--selection);
}

input::selection {
	background: var(--selection);
}

button:is(:focus-visible, :hover) {
	--active: 1;
}

.sr-only {
	position: absolute;
	width: 1px;
	height: 1px;
	padding: 0;
	margin: -1px;
	overflow: hidden;
	clip: rect(0, 0, 0, 0);
	white-space: nowrap;
	border-width: 0;
}

@media screen and (max-width: 535px) {
    form {
        width: 90%;
    }
}

#error{
  color: var(--color-alpha);
  text-align: center;
  opacity: 0.7;
}



#volver{
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top:10px;
    left: 10px;
    background-color: var(--bg-back);
    aspect-ratio: 1/1;
    width: 3%;
    border:none;
    border-radius: 10px;
    cursor:pointer;
}

  </style>
</head>
<body>
<form action="index.php?controller=login&action=registrarAdmin" method="POST">
<?php if(isset($controlador->mensaje)): ?> <!-- Si nos llega algún tipo de mensaje desde el controlador , lo mostramos-->
		<p id="error"><?php echo $controlador->mensaje; ?></p>
	<?php endif; ?>
  <div class="form-group">
    <div id="mail">
      <label for="email">Email</label>
      <input id="email" type="email" name="email" spellcheck="false" required/>
    </div>
    <div id="nombre">
      <label for="nombre">Nombre</label>
      <input id="nombre" type="text" name="nombre" required/>
    </div>
    <div id="pwd">
    <label for="password">Password</label>
    <input id="password" type="password" name="password" required />
    <button type="button" title="Reveal Password" aria-pressed="false">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <mask id="eye-open">
            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12V20H12H1V12Z" fill="#D9D9D9" stroke="black" stroke-width="1.5" stroke-linejoin="round" />
          </mask>
          <mask id="eye-closed">
            <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12V20H12H1V12Z" fill="#D9D9D9" />
          </mask>
        </defs>
        <path class="lid lid--upper" d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path class="lid lid--lower" d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <g mask="url(#eye-open)">
          <g class="eye">
            <circle cy="12" cx="12" r="4" fill="currentColor" />
            <circle cy="11" cx="13" r="1" fill="black" />
          </g>
        </g>
      </svg>
      <span class="sr-only">Reveal</span>
    </button>
  </div>
  <button id="send">
    <span class="spark"></span>
    <span class="backdrop"></span>
    <span class="text">Registrarse</span>
  </button>
  </div>
</form>
<button id="volver" onclick="window.location.href='index.php?controller=login&action=mostrarAdmin'"> <img width="80%" src="../img/iconos/volver.png" alt="back"> </button>
  <script src='../js/views/morph.js'></script>
  <script src='../js/views/scramble.js'></script>
  <script type="module" src="../js/views/login.js"></script>
</body>
</html>
