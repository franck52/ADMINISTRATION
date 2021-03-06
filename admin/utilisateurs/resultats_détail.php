	<?php
	   require('../utilisateurs/ma_session.php');
      require('../utilisateurs/mon_role.php');
      require_once('../connexion.php');
      require_once('../fonctions.php');
      $ae = annee_electorale_actuelle();
      $lastElt = getLastElection();
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.js" integrity="sha512-E378bwaeZf1nwXeJGIwTB58A5gPt5jFU3u6aTGja4ZdRFJeo/N/REKnBgNZOZlH6JdnOPO98vg2AnSGaNfCMFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<style type="text/css">
			* {
				box-sizing: border-box;
			}

			html,
			body {
				--ccft-cs-background: #000;
				--ccft-cs-on-surface: #fff;
				--ccft-cs-surface: #fff;
				--ccft-cs-primary: hsl(14, 97%, 65%);
				--ccft-cs-primary-alt: hsla(14, 97%, 65%, .3);
				--ccft-ts-primary: Montserrat, sans-serif;
				--ccft-ts-secondary: 'Abril Fatface', serif;
				--ccft-spacer-x: 40px;
				--ccft-spacer-y: 40px;
				--ccft-brand-size: 60px;

				background-color: var(--ccft-cs-background);
				font-family: var(--ccft-ts-primary);
				margin: 0;
			}

			.layout {
				background-image: url("./abidjan-1130x580.JPG");
				background-position: 0 0;
				background-size: cover;
				height: 100vh;
				overflow: hidden;
				position: relative;
			}

			.layout.nav--active main {
				opacity: .2;
				user-select: none;
			}

			.layout__backdrop,
			.layout__frontdrop {
				background-color: rgba(0, 0, 0, .3);
				content: '';
				display: block;
				height: 100%;
				left: 0;
				position: fixed;
				transform-origin: 0% 50%;
				width: 100%;
				z-index: 0;
			}

			.layout__backdrop {
				transform: scaleX(.34) translateX(calc(67% * 3));
			}

			.layout.nav--active .layout__frontdrop {
				background-color: var(--ccft-cs-primary-alt);
				visibility: visible;
			}

			.layout__frontdrop {
				opacity: 0;
				visibility: hidden;
				z-index: 2;
			}

			.layout__wrapper {
				display: grid;
				grid-template-columns: 300px repeat(3, 1fr);
				margin: auto;
				height: 100%;
			}

			.layout__main {
				transition: opacity .3s;
				z-index: 1;
			}

			.hero {
				padding-top: 10rem;
			}

			.hero-title {
				color: #fff;
				font-family: var(--ccft-ts-secondary);
				font-weight: 400;
				font-size: 4.75rem;
				line-height: 1.2;
				margin-left: auto;
				margin-right: 5rem;
				margin-bottom: 0;
				position: relative;
				width: 32.5rem;
				z-index: 1;
			}

			.hero-title em {
				display: block;
				font-size: 2rem;
				font-style: normal;
				line-height: 1.2;
				transform: translateX(2.5rem);
			}

			.hero-text {
				background-color: rgba(0, 0, 0, .3);
				color: #fff;
				font-size: .92rem;
				line-height: 1.75;
				margin: 0;
				margin-left: auto;
				margin-right: 6rem;
				padding: 5rem 3rem 3rem;
				transform: translateY(-3rem);
				width: 50%;
				z-index: 0;
			}

			.hero-text a {
				box-shadow: 0 4px #fff;
				color: #fff;
				text-decoration: none;
			}

			.hero-block--content > *:last-child {
				margin-bottom: 0;
			}

			.layout__main {
				display: flex;
				flex-direction: column;
			}

			.layout__header {
				height: 100%;
				z-index: 2;
			}

			.layout__header nav {
				height: 100%;
			}

			.layout__main {
				grid-column: span 3;
			}

			.nav {
				list-style: none;
				margin: 0;
				padding: 0;
			}

			.nav--header-1 {
				counter-reset: n;
				height: 100%;
				padding: 0 2rem;
				position: relative;
			}

			.nav--header-1 > .nav__item:not(.nav__item--home) {
				counter-increment: n;
			}

			.nav--header-1 > .nav__item:not(.nav__item--home) > .nav__link {
				color: var(--ccft-cs-on-surface);
				display: block;
				font-family: var(--ccft-ts-secondary);
				font-size: 1.75rem;
				line-height: 1;
				letter-spacing: .045em;
				padding: 1rem 1rem;
				padding-left: 3rem;
				padding-top: 3rem;
				position: relative;
				overflow: hidden;
				text-decoration: none;
				transition: transform .2s;
				transition-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
				z-index: 1;
			}

			.nav--header-1 > .nav__item > .nav__link::before {
				content: counter(n, decimal-leading-zero);
				display: block;
				font-family: var(--ccft-ts-primary);
				font-size: 6rem;
				font-weight: bold;
				left: 0;
				top: 0;
				opacity: .25;
				position: absolute;
				transition: transform .2s;
				z-index: -1;
			}

			.nav--header-1 > .nav__item > .nav__link:hover,
			.nav--header-1 > .nav__item.nav__item--active > .nav__link {
				color: var(--ccft-cs-primary);
				transform: translateX(.5rem);
			}

			.nav--header-1 > .nav__item.nav__item--active .nav--header-2 {
				visibility: visible;
			}

			.nav--header-1 .nav__item--home {
				background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14.145 8.633l-2.145-8.633-2.148 8.636c-.572.366-1.034.877-1.358 1.477l-8.494 1.887 8.494 1.887c.324.6.786 1.111 1.358 1.477l2.148 8.636 2.157-8.64c.571-.367 1.03-.879 1.353-1.479l8.49-1.881-8.492-1.884c-.324-.603-.788-1.116-1.363-1.483zm-2.145 5.367c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2zm7 5l-3.43-2.186c.474-.352.893-.771 1.245-1.245l2.185 3.431zm-3.521-11.882l3.521-2.117-2.119 3.519c-.386-.542-.86-1.015-1.402-1.402zm-6.955 9.767l-3.524 2.115 2.118-3.521c.387.543.862 1.018 1.406 1.406zm-1.34-8.453l-2.184-3.431 3.431 2.184c-.474.352-.894.772-1.247 1.247z" fill="rgb(255, 255, 255)" style="transform-origin: 50% 50%; transform: rotateZ(-27deg);"/></svg>');
				background-position: 0px 50%;
				background-repeat: no-repeat;
				background-size: var(--ccft-brand-size) var(--ccft-brand-size);
				margin-bottom: 60px;
				padding: 0;
			}

			.nav--header-1 .nav__item--home > .nav__link {
				display: block; /* Necessary for text-indent to work */
				height: calc(var(--ccft-brand-size) + 40px);
				text-indent: -999px;
			}

			.nav--header-2 {
				height: 100%;
				left: 270px;
				opacity: 0;
				padding: 2.5rem 5rem;
				position: fixed;
				top: 0;
				visibility: hidden;
				width: 100%;
			}

			.nav--header-2::before {
				background-image: url('data:image/svg+xml;utf8,<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z" fill="rgb(255, 255, 255)"/></svg>');
				background-repeat: no-repeat;
				background-size: 30px 30px;
				content: '';
				cursor: pointer;
				display: block;
				margin-bottom: 6rem;
				height: 30px;
				width: 30px;
			}

			.nav--header-2 > .nav__item {
				margin-bottom: 0.1rem;
			}

			.nav--header-2 > .nav__item > .nav__link {
				background-image: linear-gradient(to bottom, var(--ccft-cs-primary) 0%, var(--ccft-cs-primary) 100%);
				background-position: 0 100%;
				background-repeat: repeat-x;
				background-size: 6px 6px;
				color: #fff;
				font-family: var(--ccft-ts-primary);
				font-size: 2.05rem;
				font-weight: bold;
				letter-spacing: .05em;
				text-decoration: none;
				transition: background-size .25s, color .3s;
			}

			.nav--header-2 > .nav__item > .nav__link:hover {
				background-size: 6px 50px;
				color: #000000;
				}F
			</style>
		</head>
		<body>
			
			<div class="layout">
				<div class="layout__backdrop"></div>
				<div class="layout__frontdrop"></div>
				<div class="layout__wrapper">
					<header class="layout__header">
						<nav>
							<ul class="nav nav--header nav--header-1">
								<li class="nav__item nav__item--home">
									<a class="nav__link" href="../dashboard/dashboard.php">Home</a>
								</li>
									<li class="nav__item nav__item--clients">
									<a class="nav__link" href="#0">TOTO Ali</a>
									<ul class="nav nav--header nav--header-2">
										<li class="nav__item">
											<a class="nav__link" href="#0"> Abobo :<?php $val= total_secteur(2021, "ABOBO", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Adjam?? :<?php $val= total_secteur(2021, "ADJAME", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Bingerville :<?php $val= total_secteur(2021, "BINGERVILLE", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Cocody :<?php $val= total_secteur(2021, "COCODY", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Koumassi :<?php $val= total_secteur(2021, "KOUMASSI", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Marcory :<?php $val= total_secteur(2021, "MARCORY", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Plateau :<?php $val= total_secteur(2021, "PLATEAU", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Yopougon :<?php $val= total_secteur(2021, "YOPOUGON", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Porbouet :<?php $val= total_secteur(2021, "PORTBOUET", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Treicheville :<?php $val= total_secteur(2021, "TREICHEVILLE", 1, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Williasmville :<?php $val= total_secteur(2021, "WILLIAMSVILLE", 1, $lastElt); echo $val;?> voix </a>
										</li>
									</ul>
								</li>
										<li class="nav__item nav__item--clients">
									<a class="nav__link" href="#0">CROOS Toni</a>
									<ul class="nav nav--header nav--header-2">
										<li class="nav__item">
											<a class="nav__link" href="#0"> Abobo :<?php $val= total_secteur(2021, "ABOBO", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Adjam?? :<?php $val= total_secteur(2021, "ADJAME", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Bingerville :<?php $val= total_secteur(2021, "BINGERVILLE", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Cocody :<?php $val= total_secteur(2021, "COCODY", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Koumassi :<?php $val= total_secteur(2021, "KOUMASSI", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Marcory :<?php $val= total_secteur(2021, "MARCORY", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Plateau :<?php $val= total_secteur(2021, "PLATEAU", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Yopougon :<?php $val= total_secteur(2021, "YOPOUGON", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Porbouet :<?php $val= total_secteur(2021, "PORTBOUET", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Treicheville :<?php $val= total_secteur(2021, "TREICHEVILLE", 2, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Williasmville :<?php $val= total_secteur(2021, "WILLIAMSVILLE", 2, $lastElt); echo $val;?> voix </a>
										</li>
									</ul>
								</li>
								
										<li class="nav__item nav__item--clients">
									<a class="nav__link" href="#0">BIEBER Becky</a>
									<ul class="nav nav--header nav--header-2">
										<li class="nav__item">
											<a class="nav__link" href="#0"> Abobo :<?php $val= total_secteur(2021, "ABOBO", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Adjam?? :<?php $val= total_secteur(2021, "ADJAME", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Bingerville :<?php $val= total_secteur(2021, "BINGERVILLE", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Cocody :<?php $val= total_secteur(2021, "COCODY", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Koumassi :<?php $val= total_secteur(2021, "KOUMASSI", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Marcory :<?php $val= total_secteur(2021, "MARCORY", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Plateau :<?php $val= total_secteur(2021, "PLATEAU", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Yopougon :<?php $val= total_secteur(2021, "YOPOUGON", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Porbouet :<?php $val= total_secteur(2021, "PORTBOUET", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Treicheville :<?php $val= total_secteur(2021, "TREICHEVILLE", 3, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Williasmville :<?php $val= total_secteur(2021, "WILLIAMSVILLE", 3, $lastElt); echo $val;?> voix </a>
										</li>
									</ul>
								</li>
										<li class="nav__item nav__item--services">
									<a class="nav__link" href="#0">CARTER Austin</a>
									<ul class="nav nav--header nav--header-2">
										<li class="nav__item">
											<a class="nav__link" href="#0"> Abobo :<?php $val= total_secteur(2021, "ABOBO", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Adjam?? :<?php $val= total_secteur(2021, "ADJAME", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Bingerville :<?php $val= total_secteur(2021, "BINGERVILLE", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Cocody :<?php $val= total_secteur(2021, "COCODY", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Koumassi :<?php $val= total_secteur(2021, "KOUMASSI", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Marcory :<?php $val= total_secteur(2021, "MARCORY", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Plateau :<?php $val= total_secteur(2021, "PLATEAU", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Yopougon :<?php $val= total_secteur(2021, "YOPOUGON", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0"> Porbouet :<?php $val= total_secteur(2021, "PORTBOUET", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Treicheville :<?php $val= total_secteur(2021, "TREICHEVILLE", 4, $lastElt); echo $val;?> voix </a>
										</li>
										<li class="nav__item">
											<a class="nav__link" href="#0">Williasmville :<?php $val= total_secteur(2021, "WILLIAMSVILLE", 4, $lastElt); echo $val;?> voix </a>
										</li>
									</ul>
								</li>
							</ul>
						</nav>
					</header>
					<main class="layout__main">
						<section class='hero'>
							<div class="hero-block hero-block--header">
								<h1 class="hero-title">
									ELection <?php echo $ae;?> <em>Cliquer sur le nom de chaque candidat pour afficher son resultat</em>

								</h1>
								<p class="hero-text">Ici, vous avez la possiblit?? de suivre l'??volution du d??pouillement par candidat. Un peu comment le resum?? des resultats obtenus par candidat</p>
							</div>
						</section>
					</main>
				</div>
			</div>
	<script type="text/javascript">
	const items = document.querySelectorAll('.nav--header-1 > .nav__item');
	const rootElement = document.querySelector('.layout');

		const colors = ['hsla(14, 97%, 65%, 0.4)',];			

		// Local state.
		const state = {
			navigationItems: {},
			root: rootElement,
		};

		for (let navItemIndex = 0; navItemIndex < items.length; ++navItemIndex) {
			const stateItem = {
				color: colors[navItemIndex % colors.length],
				element: items[navItemIndex],
				id: navItemIndex,
				isActive: false,
				type: 'DEFAULT',
			} 

			const subNav =  items[navItemIndex].querySelector('.nav');
			if (subNav) {
		    // current element has a subNav.
		    stateItem.childNavigation = subNav;
		    stateItem.type = 'PARENT';
		}

		stateItem.onClick = (event) => {
			const actualOnClick = () => {
				if (state.activeItem === navItemIndex) {
					return;
				}

				if (state.activeItem) {
					state.activeItem = null;
				} 

				if ('PARENT' === state.navigationItems[navItemIndex].type) {
		        // Set new active item.
		        state.activeItem = navItemIndex;

		        animateShow(state);
		    }
		};

		if (state.activeItem) {
			return animateHide(state, actualOnClick);
		}

		return actualOnClick();
	};

		  // Add this item to the state.
		  state.navigationItems[navItemIndex] = stateItem;
		}

		const animateShow = (state) => {
			const animation = anime.timeline();
			console.log(state.navigationItems[state.activeItem]);

			animation.add({
				backgroundColor: state.navigationItems[state.activeItem].color,
				begin: () => {
					state.root.classList.add('nav--active');
				},
				complete: () => {
					state.navigationItems[state.activeItem].element.classList.add('nav__item--active');
				},
				duration: 450,
				easing: 'easeOutExpo',
				opacity: 1,
				translateX: [
				{delay: 300, value: '270px',},
				],
				scaleX: [
				{value: 0},
				{value: 1},
				],
				targets: '.layout__frontdrop',
			})
			.add({
				duration: 70,
				opacity: [0, 1],
				targets: state.navigationItems[state.activeItem].childNavigation,
			}).add({
				delay: anime.stagger(70),
				opacity: [0, 1],
				translateY: ['100%', '0'],
				targets: state.navigationItems[state.activeItem].childNavigation.querySelectorAll('.nav__item'),
			});

			return animation;
		};

		const animateHide = (state, complete) => {
			const animation = anime.timeline({
				complete: complete,
			});

			animation.add({
				duration: 210,
				opacity: [1, 0],
				translateY: [0, '+=50px'],
				targets: state.navigationItems[state.activeItem].childNavigation,
			}).add({
				complete: () => {
		      // Clean-up current active item.
		      state.root.classList.remove('nav--active');
		      state
		      .navigationItems[state.activeItem]
		      .element
		      .classList
		      .remove('nav__item--active')
		      ;
		  },
		  duration: 250,
		  easing: 'easeOutCirc',
		  scaleX: [
		  {value: 0,},
		  ],
		  translateX: [
		  {value: 0},
		  ],
		  targets: '.layout__frontdrop',
		});

			return animation;
		};

		(() => {
		  // Ready to fight.
		  const introAnimation = anime.timeline({
		  	complete: () => {
		  		for (let stateItemIndex = 0; stateItemIndex < Object.values(state.navigationItems).length; ++ stateItemIndex) {
		  			state.navigationItems[stateItemIndex].element.addEventListener(
		  				'click',
		  				state.navigationItems[stateItemIndex].onClick
		  				);

		        // Reset transform to prevent the implicit z-index / position relative to trigger.
		        state.navigationItems[stateItemIndex].element.style.transform = '';
		    }
		},
	});

		  introAnimation.add({
		  	duration: 350,
		  	delay: 1000,
		  	easing: 'easeOutCirc',
		  	targets: '.layout__backdrop',
		  	scaleX: [0, 1],
		  }).add({
		  	delay: anime.stagger(75),
		  	duration: 450,
		  	easing: 'easeOutCirc',
		  	opacity: [0, 1],
		  	translateY: ['100%', '0%'],
		  	targets: '.nav--header-1 > .nav__item:not(.nav__item--home)',
		  }).add({
		  	easing: 'easeOutExpo',
		  	targets: '.layout__backdrop',
		  	translateX: [
		  	{delay: 350, value: (67) + '%'},
		  	],
		  }).add({
		  	duration: 350,
		  	easing: 'easeOutExpo',
		  	targets: '.hero-title',
		  	opacity: [0, 1],
		  	translateY: ['50px', '0'],
		  }).add({
		  	duration: 350,
		  	easing: 'easeOutExpo',
		  	targets: '.hero-text',
		  	opacity: [0, 1],
		  	translateY: ['0', '-3rem'],
		  }, '-=100');
		})();
	  </script>

 </body>
</html>