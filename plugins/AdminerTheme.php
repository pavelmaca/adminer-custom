<?php

/**
 * Adds support for Pematon's custom theme.
 * This includes meta headers, touch icons and other stuff.
 *
 * @author Peter Knut
 * @copyright 2014-2015 Pematon, s.r.o. (http://www.pematon.com/)
 */
class AdminerTheme
{
	/** @var string */
	private $themeName;

	/**
	 * @param string $themeName File with this name and .css extension should be located in css folder.
	 */
	function AdminerTheme($themeName = "default-orange")
	{
		define("PMTN_ADMINER_THEME", true);

		$this->themeName = $themeName;
	}

	/**
	 * Prints HTML code inside <head>.
	 * @return false
	 */
	public function head()
	{
		$userAgent = filter_input(INPUT_SERVER, "HTTP_USER_AGENT");
		?>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, target-densitydpi=medium-dpi"/>

		<link rel="icon" type="image/ico" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAtlJREFUeNrkl1tIVFEUhs9JMQO7WZEUgUQgPVSUBvVQEl0ojAZTFMqEjCKYrCEnEzUrs/GC2ZRjPjlBWml5oSi6E1MPFWXhYyQWRFJUEzlBFuPZ/QvWwDBM09l7Bnxow8c6nH1bZ6+9/72OLoTQxrNM0Ma5xJtpdPJ8/0SYdWAVWALmg1lgMjfxgc9gCAyAx+B+xc70X/8aW48Ughr3i5kw5aAITJX8uO/ADRyVRRlfpB2obntOX3oTzI1ylT+ArKpdywekQiAM4Y7B5BqP0Q4WSzlgCLE0hnttkfQmNAxDH9dTMGYIL0xyjObxSesAVsAFtBhxWmEFjGNkQAVIUPzy3yQj4ISSDlApcXpSYawgH8wzOfF70AXOnbJlvlUSIlvTQ6vz4JqWkHcLYJYBsrPBJK76CT6BQfAS/QZD+tnwzinlQHHjAz/MUVDfbF/rV1l/jEEhPgyOY4x42WMYR2oMtlsb7p2FvdpSuv6rmYnRnk5PHtgPFqodwzEj8EgDtALX3to7r2D7wRswDAKXDV1Wczg06RymuCh1wPAF3XYaD5jByJYfKg50wuyOkRBdVglBCUwaWB3l5I/AISUdKKi6Rg7aQBmYITkxbdg64OyotvilHdhW2ZdzqSa7h58TYbLpXgcrQWoYGadd+w484TyiD/1HQ8cy7UB+eQ9tnKwuR44nTF0i7/qkoE02jLajYdpmkkOoS5JyILesW7CW14PG7rrcEZn1R/8pMHYWogT012WFyOBL6AgJytbSK6Tt12mJexvyvOH6oE0yh2gLC9G0aHRgiIVF44R0D6NZ7J0fOdf7xvXTOfVKiXA5yWZEog2m9i/VKREmC1daVVIySiIsYEWUOvAUNCnpwKYDHbSRLoLNipPfoMvs1pmCEeWEZGNxu84a4GBlNFNecybVe7t5h1D+MwouG/Zd0DkcgbCkcVJCZ9/LIvSMv9pz11VomBlX/+//jv8IMADvIkZPh14JqAAAAABJRU5ErkJggg==">

		<?php
			// Condition for Windows Phone has to be the first, because IE11 contains also iPhone and Android keywords.
			if (strpos($userAgent, "Windows") !== false):
		?>
			<meta name="application-name" content="Adminer"/>
			<meta name="msapplication-TileColor" content="#ffffff"/>
			<meta name="msapplication-square150x150logo" content="data:image/png;base64,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"/>
			<meta name="msapplication-wide310x150logo" content="data:image/png;base64,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"/>

		<?php elseif (strpos($userAgent, "iPhone") !== false || strpos($userAgent, "iPad") !== false): ?>
			<link rel="apple-touch-icon-precomposed" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAABgFBMVEVMaXH///////////////////////////////////////////////////////////////////////////////////////////////////////9LcKVdf7JIbqRlhbhFbKJHbaNZfK9Oc6hjg7VkhLZhgrRfgLNMcaZNcqdggbNKb6RYeq5bfbBwjr5Rdalsi7toh7hQdKmVq8tUd6tpiLqLo8izw9r7/P7c4+5Xeq2kt9SPpsl/mcKqvNV5lb3X3+yEncXAzeFykLnn7PN1kr7q7/WcsM5nh7RpibN5lb/////giET56d301LvVXQD89O7mnmb338zbcyLrs4juvpnl6vOfs9fr7/bdfTO3xt57l8awwd2Dnsx3lMOHoMvF0eWCnMrpqXd1ksLYaBHw8/j19/vQ2uqYrdLL1ueVrNSkuNnxyar5+vyOpcx/msmBnMfi6PGCncuuv9rjk1XCz+SAm8l2k8N0kcF6lsV9mMd+mch5lcVxj79ykMB8mMd4lcQFIAOzAAAAG3RSTlMAeZPW7fkSA1WygKuFCZDnDB/O8zfhG6iZddLh73vRAAAEb0lEQVR4AcTB1QGFMBAEwIUkuDuUtPRfz3OXz9zN4F27zh096PK1xV9RttGjLYvwSxP09KwPGnxJagqoE7yLKwqpYrwoU4pJSzzEKQWlMe4qiqpwk1BYgovIUpiNcBZSXIiTyVGcmwAUVFAA8UgFY4yBKgYEVBFgpooZhioMLFVYOKpwoH/7fiSmLhMbh6EojO7vmpkZYiq3w7D1sVVWNJEV/P6EcwxPknRLwefOAaukytIuARNauQRMGs8LK4pi+QSu5BPDMkOvFrk4LWyrNkNeYPOkcKGqLJlc7RPC2sMCVBropNPCMjkx3wCdVi3vr4Ynp80C13X7eK6fnwRZ60z4bwaZoQdt29XVOWsV7HUR8bbro84De6yWCvpdSZLUpUrjw97j5m5nm0ePOVZqZYPKUp+rDPBgZ7hb0eAwrqZpAGxYksGB6yFf2VB/cMlYSRp7CZv2zHLgNs1Xl7bvU0tcgA1LAA/unoTqPm+K+t6wk18LlTt4yXhewhoTtriwey2Yi9c0iT1dJC4c/xAsxns6tZ5E4O/Cba8c6roakmqOXPiPcPjYyNgzTXVO5sGhcNTpmfSIKfRVYMPfhMPnNJ9aVTKBbR78U7QQdPriUlu4Dx6c/hUsxVb0WCuWDS4cJIIFEI0NNzdfhLppjgTjNiwFCm9xLBje1dfVXXk4HowpSn6vKokmHA0m1fclny3va+CYMKnJNr92tskaHNA/WsxySXUYgMLvse6+zd70JhChuGx+X3ehDFLW338FbdFk5vDh9Mx89Z5mUcusN+Wvy5n8ks3ewkLFLEwsePr3g2RsaGRMPvxOJxMMJCbdyDgQdQlKTLoOq7HeJTgx+dk0ljR/Epj4/Rv6yWJ9R0+6F4aJe5T4kqMl5KVeECa+GkIUz85Z7ijLFRkFQeKtBLeZ5l3y6LlrZm6TGbQ4hs7lcpS+vumJCVDxgSOoVX2978g1SCwPHZEgcf3q1ImDOkhs8kdO5HGXxa8bDnxFXo+b+7ba/Sa2CHxkF1awj/AG0ijtLqXUWEn1ydKjRdYjmkVXn2jc9yg5nwmh46YXMZBYUBOjnJcqEDECJfPleIIKlFjwGbc16R4zble4QIl936+kjCWpymscJ/a15WHyUfs4sfeGkKFZSihFLwwT9zivFM1CipVzz0OK340IHspmDuWHYJxDLfFejKri6ZRJkEpzVY1nUEtc3ZtEFBillPPXN1YQe5NUQWJ14ogCibPHjmRBYqPXndAGJS76Ll7/I0xsmsdn1hw3kdfj/PqmJet5bBFoCDuvaKAbSD3YsSBYxXATF8u0gq9muCnKeNsL8DKRQYrjhLwwT1vgIXycK0E5U1iflK4XMuVkCi/ucfeVBrXa63r3arWAfu31LoT4pX2zNgAYhgFYmXHL/4+WGUZHKegBwyxp4x8MgYlknDqHyYIpMzjFhFBMgcWkX0pzxsRuSmVn5X0oVwCe7fBJChXhdIRK11wV8qHVRJXIp2VJdRPTuZJj3SywbqntVCgftOv9pBZvz77ha/zcrwAAAABJRU5ErkJggg=="/>

		<?php elseif (strpos($userAgent, "Android") !== false): ?>
			<link rel="apple-touch-icon-precomposed" href="data:image/png;base64,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"/>

		<?php else: ?>
			<link rel="apple-touch-icon" href="images/touchIcon.png"/>
		<?php endif; ?>

		<link rel="stylesheet" type="text/css" href="static/css/<?php echo htmlspecialchars($this->themeName) ?>.css">

		<script>
			(function(window) {
				"use strict";

				window.addEventListener("load", function() {
					prepareMenuButton();
				}, false);

				function prepareMenuButton() {
					var menu = document.getElementById("menu");
					var button = menu.getElementsByTagName("h1")[0];
					if (!menu || !button) {
						return;
					}

					button.addEventListener("click", function() {
						if (menu.className.indexOf(" open") >= 0) {
							menu.className = menu.className.replace(/ *open/, "");
						} else {
							menu.className += " open";
						}
					}, false);
				}

			})(window);

		</script>

		<?php

		// Return false to disable linking of adminer.css and original favicon.
		// Warning! This will stop executing head() function in all plugins defined after AdminerTheme.
		return false;
	}
}
