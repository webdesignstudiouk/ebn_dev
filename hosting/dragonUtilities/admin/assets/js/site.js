 function() {
	"use strict";
	angular.module("material-lite", ["app.constants", "ngRoute", "ngAnimate",
		"ngSanitize", "angular.mdl", "ml.chat", "ml.menu", "ml.svg-map", "ml.todo",
		"ui.select", "ngFileUpload", "ngWig", "pikaday", "ngPlaceholders",
		"ngTable", "uiGmapgoogle-maps", "gridshore.c3js.chart", "angularGrid",
		"LocalStorageModule"
	])
}(),

function() {
	"use strict";

	function a(a, b) {
		a.APP = b
	}

	function b(a, b) {
		a.$on("$viewContentLoaded", function(a) {
			b(function() {
				var a = document.querySelector(".mdl-layout");
				a.classList.add("mdl-js-layout"), componentHandler.upgradeElement(a,
					"MaterialLayout")
			})
		})
	}

	function c(a) {
		a.configure({
			v: "3.17",
			libraries: "weather,geometry,visualization"
		})
	}
	angular.module("material-lite").run(["$rootScope", "APP", a]).run([
		"$rootScope", "$timeout", b
	]).config(["uiGmapGoogleMapApiProvider", c])
}(), angular.module("app.constants", []).constant("APP", {
		version: "1.0.0"
	}),
	function() {
		"use strict";

		function a(a) {
			a.onPikadaySelect = function(a, b) {
				var c = new Event("input");
				a._o.field.dispatchEvent(c)
			}
		}
		angular.module("material-lite").controller("MainController", ["$scope", a])
	}(),
	function() {
		"use strict";

		function a(a, b) {
			var c = function(a, b) {
					return Math.floor(Math.random() * (b - a + 1)) + a
				},
				d = function(a, b, d) {
					for (var e = [], f = 0; a > f; ++f) e.push(c(b, d));
					return e
				},
				e = function(a, b, d) {
					for (var e = [], f = 0; a > f; ++f)
						if (e.length) {
							var g = 10,
								h = e[e.length - 1] - g,
								i = e[e.length - 1] + g;
							e.push(c(b > h ? b : h, i > d ? d : i))
						} else e.push(c(b, d));
					return e
				};
			b.chartData1 = d(75, 5, 200).join(), b.chartData2 = d(24, 5, 200).join(), b
				.chartData3 = d(20, 5, 200).join(), b.chartData4 = e(50, 10, 30).join(), b
				.chartData5 = e(18, 10, 30).join();
			var f = !1;
			a(function() {
				b.$broadcast("chat:receiveMessage",
					"I have a problem with an order, could you help me out?")
			}, 3e3), b.$on("chat:sendMessage", function() {
				f || (f = !0, a(function() {
					b.$broadcast("chat:receiveMessage", "Thanks!")
				}, 2e3))
			})
		}
		angular.module("material-lite").controller("DashboardController", ["$timeout",
			"$scope", a
		])
	}(),
	function() {
		"use strict";

		function a(a, b) {
			a.todoService = new b(a)
		}
		angular.module("material-lite").controller("TodoController", ["$scope",
			"TodoService", a
		])
	}(),
	function() {
		"use strict";

		function a() {
			var a = document.querySelector("#p1"),
				b = document.querySelector("#p3");
			a.addEventListener("mdl-componentupgraded", function() {
				this.MaterialProgress.setProgress(44)
			}), b.addEventListener("mdl-componentupgraded", function() {
				this.MaterialProgress.setProgress(33), this.MaterialProgress.setBuffer(
					87)
			}), componentHandler.downgradeElements([a, b]), componentHandler.upgradeElement(
				a, "MaterialProgress"), componentHandler.upgradeElement(b,
				"MaterialProgress")
		}
		angular.module("material-lite").controller("LoadingController", a)
	}(),
	function() {
		"use strict";

		function a(a, b) {
			this.loadImages = function() {
				return b.get("js/demo/apis/gallery.json")
			}
		}

		function b(a) {
			return function(b, c) {
				a.enabled(!1, c)
			}
		}

		function c(a, b, c) {
			a.type = "", b.loadImages().then(function(b) {
				var c = b.data;
				a.images = c, a.searchTxt = "", a.$watch("searchTxt", function(b) {
					b = b.toLowerCase(), a.images = c.filter(function(a) {
						return -1 != a.title.toLowerCase().indexOf(b)
					})
				}), a.showType = function(b) {
					b = b.toLowerCase(), a.images = c.filter(function(a) {
						return -1 != a.type.toLowerCase().indexOf(b)
					})
				}, a.sortByLikes = function() {
					a.images.sort(function(a, b) {
						return b.likes - a.likes
					})
				}, a.sortByWatch = function() {
					a.images.sort(function(a, b) {
						return b.watch - a.watch
					})
				}, a.sortByTime = function() {
					a.images.sort(function(a, b) {
						return b.time - a.time
					})
				}
			})
		}
		angular.module("material-lite").directive("disableAnimate", ["$animate", b]).service(
			"imageService", ["$q", "$http", a]).controller("GalleryController", [
			"$scope", "imageService", "angularGridInstance", c
		])
	}(),
	function() {
		"use strict";

		function a(a) {
			a.person = {}, a.people = [{
				name: "Adam",
				email: "adam@email.com",
				age: 12,
				country: "United States"
			}, {
				name: "Amalie",
				email: "amalie@email.com",
				age: 12,
				country: "Argentina"
			}, {
				name: "EstefanÃ­a",
				email: "estefania@email.com",
				age: 21,
				country: "Argentina"
			}, {
				name: "Adrian",
				email: "adrian@email.com",
				age: 21,
				country: "Ecuador"
			}, {
				name: "Wladimir",
				email: "wladimir@email.com",
				age: 30,
				country: "Ecuador"
			}, {
				name: "Samantha",
				email: "samantha@email.com",
				age: 30,
				country: "United States"
			}, {
				name: "Nicole",
				email: "nicole@email.com",
				age: 43,
				country: "Colombia"
			}, {
				name: "Natasha",
				email: "natasha@email.com",
				age: 54,
				country: "Ecuador"
			}, {
				name: "Michael",
				email: "michael@email.com",
				age: 15,
				country: "Colombia"
			}, {
				name: "NicolÃ¡s",
				email: "nicolas@email.com",
				age: 43,
				country: "Colombia"
			}], a.availableColors = ["Red", "Green", "Blue", "Yellow", "Magenta",
				"Maroon", "Umbra", "Turquoise"
			], a.selectedState = "", a.states = ["Alabama", "Alaska", "Arizona",
				"Arkansas", "California", "Colorado", "Connecticut", "Delaware",
				"Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa",
				"Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts",
				"Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska",
				"Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York",
				"North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon",
				"Pennsylvania", "Rhode Island", "South Carolina", "South Dakota",
				"Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington",
				"West Virginia", "Wisconsin", "Wyoming"
			]
		}
		angular.module("material-lite").controller("SelectController", ["$scope", a])
	}(),
	function() {
		"use strict";

		function a(a, b, c) {
			a.fileReaderSupported = void 0 !== window.FileReader && (void 0 === window.FileAPI ||
				FileAPI.html5 !== !1), a.$watch("files", function() {
				a.upload(a.files)
			});
			var d = function(a) {
					var b = parseInt(100 * a.loaded / a.total);
					console.log("progress: " + b + "% " + a.config.file.name)
				},
				e = function(a, b, c, d) {
					console.log("file " + d.file.name + "uploaded. Response: " + JSON.stringify(
						a))
				},
				f = function(a) {
					g(a)
				},
				g = function(b) {
					void 0 !== b && a.fileReaderSupported && b.type.indexOf("image") > -1 &&
						c(function() {
							var a = new FileReader;
							a.readAsDataURL(b), a.onload = function(a) {
								c(function() {
									b.dataUrl = a.target.result
								})
							}
						})
				};
			a.upload = function(a) {
				if (a && a.length)
					for (var c = 0; c < a.length; c++) {
						var f = a[c];
						b.upload({
							url: "#",
							file: f
						}).progress(d).success(e)
					}
			}, a.$watch("files", function(b) {
				if (a.formUpload = !1, void 0 !== b && null !== b)
					for (var c = 0; c < b.length; c++) a.errorMsg = void 0, f(b[c])
			})
		}
		angular.module("material-lite").controller("UploadController", ["$scope",
			"Upload", "$timeout", a
		])
	}(),
	function() {
		"use strict";

		function a(a) {
			a.text1 =
				"<h1>Lorem ipsum</h1><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe maxime similique, ab voluptate dolorem incidunt, totam dolores illum eum ad quas odit. Magnam rerum doloribus vitae magni quasi molestias repellat.</p><ul><li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus tempora explicabo fugit unde maxime alias.</li><li>Numquam, nihil. Fugiat aspernatur suscipit voluptatum dolorum nisi numquam, fugit at, saepe alias assumenda autem.</li><li>Iste dolore sed placeat aperiam alias modi repellat dolorem, temporibus odio adipisci obcaecati, est facere!</li><li>Quas totam itaque voluptatibus dolore ea reprehenderit ut quibusdam, odit beatae aliquam, deleniti unde tempora!</li><li>Rerum quis soluta, necessitatibus. Maxime repudiandae minus at eum, dicta deserunt dignissimos laborum doloribus. Vel.</li></ul><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis enim illum, iure cumque amet. Eos quisquam, nemo voluptates. Minima facilis, recusandae atque ullam illum quae iure impedit nihil dolorum hic?</p>"
		}
		angular.module("material-lite").controller("TextEditorController", ["$scope",
			a
		])
	}(),
	function() {
		"use strict";

		function a(a) {
			a.map = {
				center: {
					latitude: 40.399516,
					longitude: -22.703348
				},
				zoom: 2
			}, a.centerOn = function(b, c) {
				a.map.center = {
					latitude: b,
					longitude: c
				}
			};
			var b = [];
			b.push({
				id: 0,
				latitude: 52.369371,
				longitude: 4.894494,
				title: "Amsterdam"
			}), b.push({
				id: 1,
				latitude: 40.712942,
				longitude: -74.005774,
				title: "New York"
			}), b.push({
				id: 2,
				latitude: 41.385196,
				longitude: 2.173315,
				title: "Barcelona"
			}), b.push({
				id: 3,
				latitude: 37.764355,
				longitude: -122.451954,
				title: "San Francisco"
			}), a.markers = b
		}
		angular.module("material-lite").controller("ClickableMapController", [
			"$scope", a
		])
	}(),
	function() {
		"use strict";

		function a(a, b) {
			a.map = {
				center: {
					latitude: 40.399516,
					longitude: -22.703348
				},
				control: {},
				zoom: 2
			}, b.then(function(b) {
				a.searchFor = function(c) {
					var d = new b.Geocoder;
					d.geocode({
						address: c
					}, function(c, d) {
						if (d == b.GeocoderStatus.OK) {
							var e = c[0].geometry.location;
							a.map.control.refresh({
								latitude: e.lat(),
								longitude: e.lng()
							}), a.map.control.getGMap().setZoom(6)
						}
					})
				}
			})
		}
		angular.module("material-lite").controller("SearchableMapController", [
			"$scope", "uiGmapGoogleMapApi", a
		])
	}(),
	function() {
		"use strict";

		function a(a) {
			var b = !1;
			a.map = {
				center: {
					latitude: 52.369371,
					longitude: 4.894494
				},
				control: {},
				events: {
					zoom_changed: function(c, d, e) {
						if (b === !1) {
							var f = a.getMapInstance().getZoom();
							a.zoom_level = f
						} else b = !1
					}
				},
				zoom: 5
			}, a.update_zoom = function() {
				b = !0, a.getMapInstance().setZoom(parseInt(a.zoom_level))
			}, a.getMapInstance = function() {
				return a.map.control.getGMap()
			}
		}
		angular.module("material-lite").controller("ZoomableMapController", ["$scope",
			a
		])
	}(),
	function() {
		"use strict";

		function a(a) {
			a.map = {
				center: {
					latitude: 52.369371,
					longitude: 4.894494
				},
				control: {},
				zoom: 5
			}, a.options = {
				styles: [{
					featureType: "all",
					elementType: "labels.text.fill",
					stylers: [{
						color: "#ffffff"
					}]
				}, {
					featureType: "all",
					elementType: "labels.text.stroke",
					stylers: [{
						color: "#000000"
					}, {
						lightness: 13
					}]
				}, {
					featureType: "administrative",
					elementType: "geometry.fill",
					stylers: [{
						color: "#000000"
					}]
				}, {
					featureType: "administrative",
					elementType: "geometry.stroke",
					stylers: [{
						color: "#144b53"
					}, {
						lightness: 14
					}, {
						weight: 1.4
					}]
				}, {
					featureType: "landscape",
					elementType: "all",
					stylers: [{
						color: "#08304b"
					}]
				}, {
					featureType: "poi",
					elementType: "geometry",
					stylers: [{
						color: "#0c4152"
					}, {
						lightness: 5
					}]
				}, {
					featureType: "road.highway",
					elementType: "geometry.fill",
					stylers: [{
						color: "#000000"
					}]
				}, {
					featureType: "road.highway",
					elementType: "geometry.stroke",
					stylers: [{
						color: "#0b434f"
					}, {
						lightness: 25
					}]
				}, {
					featureType: "road.arterial",
					elementType: "geometry.fill",
					stylers: [{
						color: "#000000"
					}]
				}, {
					featureType: "road.arterial",
					elementType: "geometry.stroke",
					stylers: [{
						color: "#0b3d51"
					}, {
						lightness: 16
					}]
				}, {
					featureType: "road.local",
					elementType: "geometry",
					stylers: [{
						color: "#000000"
					}]
				}, {
					featureType: "transit",
					elementType: "all",
					stylers: [{
						color: "#146474"
					}]
				}, {
					featureType: "water",
					elementType: "all",
					stylers: [{
						color: "#021019"
					}]
				}]
			}
		}
		angular.module("material-lite").controller("StyledMapController", ["$scope",
			a
		])
	}(),
	function() {
		"use strict";

		function a(a) {
			a.map = {
				center: {
					latitude: 40.399516,
					longitude: -22.703348
				},
				zoom: 3
			}, a.centerOn = function(b, c) {
				a.map.center = {
					latitude: b,
					longitude: c
				}
			};
			var b = [];
			b.push({
				id: 0,
				latitude: 52.369371,
				longitude: 4.894494,
				title: "Amsterdam"
			}), b.push({
				id: 1,
				latitude: 40.712942,
				longitude: -74.005774,
				title: "New York"
			}), b.push({
				id: 2,
				latitude: 41.385196,
				longitude: 2.173315,
				title: "Barcelona"
			}), b.push({
				id: 3,
				latitude: 37.764355,
				longitude: -122.451954,
				title: "San Francisco"
			}), a.markers = b
		}
		angular.module("material-lite").controller("FullMapController", ["$scope", a])
	}(),
	function() {
		"use strict";

		function a(a) {
			var b = [];
			b.push("#4CAF50"), b.push("#2196F3"), b.push("#9c27b0"), b.push("#ff9800"),
				b.push("#F44336"), a.color_pattern = b.join()
		}
		angular.module("material-lite").controller("ChartsController", ["$scope", a])
	}(),
	function() {
		"use strict";

		function a(a, b, c, d) {
			for (var e = [], f = 200, g = 1; f >= g; g++) e.push({
				icon: b.createIcon(),
				firstname: b.createFirstname(),
				lastname: b.createLastname(),
				paragraph: b.createSentence()
			});
			a.data = e, a.tableParams = new c({
				page: 1,
				count: 10,
				sorting: {
					firstname: "asc"
				}
			}, {
				filterDelay: 50,
				total: e.length,
				getData: function(a, b) {
					var c = b.filter().search,
						f = [];
					c ? (c = c.toLowerCase(), f = e.filter(function(a) {
						return a.firstname.toLowerCase().indexOf(c) > -1 || a.lastname.toLowerCase()
							.indexOf(c) > -1
					})) : f = e, f = b.sorting() ? d("orderBy")(f, b.orderBy()) : f, a.resolve(
						f.slice((b.page() - 1) * b.count(), b.page() * b.count()))
				}
			})
		}
		angular.module("material-lite").controller("TablesDataController", ["$scope",
			"PlaceholderTextService", "ngTableParams", "$filter", a
		])
	}(),
	function() {
		"use strict";

		function a() {
			return {
				restrict: "A",
				link: function(a, b, c) {
					angular.forEach(b.children(), function(a) {
						var b = angular.element(a),
							c = b.attr("class").match(/mdl-color--(.*?)($|\s)/g)[0];
						b.html(c), /-900 $/g.test(c) && b.after("<br/>")
					})
				}
			}
		}
		angular.module("material-lite").directive("dynamicColor", a)
	}(),
	function() {
		"use strict";

		function a() {
			return {
				restrict: "E",
				templateUrl: "tpl/demo/partials/header.html",
				replace: !0
			}
		}
		angular.module("material-lite").directive("mlHeader", a)
	}(),
	function() {
		"use strict";

		function a() {
			return {
				restrict: "E",
				templateUrl: "tpl/demo/partials/sidebar.html",
				replace: !0
			}
		}
		angular.module("material-lite").directive("mlSidebar", a)
	}(),
	function() {
		"use strict";

		function a(a, b) {
			var c = this;
			c.getConversations = function() {
				return b.getConversations()
			}, a.conversations = [], a.currentConversation = {
				name: "Undefined",
				messages: []
			}, a.$on("chat:receiveMessage", function(c, d) {
				a.currentConversation.messages.push(b.prepareMessage(d, !1))
			}), a.switchConversation = function(b) {
				a.currentConversation = b
			}, a.sendMessage = function() {
				"" !== a.message && void 0 !== a.message && (a.currentConversation.messages
					.push(b.prepareMessage(a.message, !0)), a.message = "", a.$emit(
						"chat:sendMessage"))
			}
		}

		function b(a, b, c) {
			function d(a, b) {
				return {
					text: a,
					datetime: moment().format(),
					me: b
				}
			}

			function e() {
				var d = a.defer();
				return b.get(c.endpoint, {
					cache: "true"
				}).then(function(a) {
					d.resolve(a)
				}, function(a) {}), d.promise
			}
			return {
				prepareMessage: d,
				getConversations: e
			}
		}

		function c() {
			return {
				restrict: "EA",
				controller: "mlChatController",
				templateUrl: "tpl/partials/chat-widget.html"
			}
		}

		function d() {
			function a(a, b, c, d) {
				d.getConversations().then(function(b) {
					a.conversations = b.data, a.currentConversation = a.conversations[0]
				})
			}
			return {
				restrict: "EA",
				controller: "mlChatController",
				link: a
			}
		}

		function e() {
			function a(a) {
				return a && a.length ? moment(a).format("LLL") : void 0
			}
			return a
		}
		angular.module("ml.chat", []).constant("mlChatConfig", {
			endpoint: "js/demo/apis/chats.json"
		}).controller("mlChatController", ["$scope", "mlChatService", a]).factory(
			"mlChatService", ["$q", "$http", "mlChatConfig", b]).directive(
			"mlChatWidget", c).directive("mlChatApp", d).filter("mlChatDate", e)
	}(),
	function() {
		"use strict";

		function a(a, b, c, d, e) {
			var f = this;
			f.groups = [], f.items = [], f.closeOthers = function(c) {
				var d = angular.isDefined(b.closeOthers) ? a.$eval(b.closeOthers) : e.closeOthers;
				d && angular.forEach(f.groups, function(a) {
					a !== c && (a.isOpen = !1)
				})
			}, f.inactivateOthers = function(a) {
				angular.forEach(f.items, function(b) {
					b !== a && (b.isActive = !1)
				})
			}, f.addGroup = function(a) {
				a.isOpen = !0, f.groups.push(a)
			}, f.addItem = function(a) {
				f.items.push(a)
			}, f.isOpen = function(a) {
				var b = c.path().split("/")[1];
				return b == a
			}, f.isActive = function(a) {
				return c.path() == a.slice(1, a.length)
			}, f.setBreadcrumb = function(a) {
				d.pageTitle = a
			}
		}

		function b() {
			return {
				restrict: "EA",
				controller: "MenuController"
			}
		}

		function c() {
			function a(a, b, c, d) {
				d.addItem(a), a.$watch("isActive", function(b) {
					b && d.inactivateOthers(a)
				});
				var e = angular.element(b.children()[0]).attr("href");
				a.isActive = d.isActive(e), a.toggleActive = function() {
					a.isActive || (a.isActive = !a.isActive);
					var c = b.find("a").clone();
					c.find("i").remove();
					var e = c.text().trim();
					d.setBreadcrumb("Dashboard" == e ? "" : e)
				}
			}
			return {
				require: "^mlMenu",
				restrict: "EA",
				transclude: !0,
				replace: !0,
				templateUrl: "tpl/partials/menu-item.html",
				scope: {
					isActive: "=?"
				},
				link: a
			}
		}

		function d() {
			function a(a, b, c, d) {
				d.addGroup(a), a.$watch("isOpen", function(b) {
					b && d.closeOthers(a)
				}), a.isOpen = d.isOpen(c.path), a.toggleOpen = function() {
					a.isOpen = !a.isOpen
				}
			}
			return {
				require: "^mlMenu",
				restrict: "EA",
				transclude: !0,
				replace: !0,
				templateUrl: "tpl/partials/menu-group.html",
				scope: {
					heading: "@",
					path: "@",
					isOpen: "=?"
				},
				controller: function() {
					this.setHeading = function(a) {
						this.heading = a
					}
				},
				link: a
			}
		}

		function e() {
			function a(a, b, c, d, e) {
				d.setHeading(e(a, angular.noop))
			}
			return {
				restrict: "EA",
				transclude: !0,
				template: "",
				replace: !0,
				require: "^mlMenuGroup",
				link: a
			}
		}

		function f() {
			function a(a, b, c, d) {
				a.$watch(function() {
					return d[c.mlMenuTransclude]
				}, function(a) {
					a && (b.html(""), b.replaceWith(a))
				})
			}
			return {
				require: "^mlMenuGroup",
				link: a
			}
		}

		function g(a) {
			function b(b, c, d) {
				function e() {
					c.removeClass("collapse").addClass("collapsing"), a.addClass(c, "in", {
						to: {
							height: c[0].scrollHeight + "px"
						}
					}).then(f)
				}

				function f() {
					c.removeClass("collapsing"), c.css({
						height: "auto"
					})
				}

				function g() {
					c.css({
						height: c[0].scrollHeight + "px"
					}).removeClass("collapse").addClass("collapsing"), a.removeClass(c,
						"in", {
							to: {
								height: "0"
							}
						}).then(h)
				}

				function h() {
					c.css({
						height: "0"
					}), c.removeClass("collapsing"), c.addClass("collapse")
				}
				b.$watch(d.collapse, function(a) {
					a ? g() : e()
				})
			}
			return {
				link: b
			}
		}
		angular.module("ml.menu", []).constant("menuConfig", {
			closeOthers: !0
		}).controller("MenuController", ["$scope", "$attrs", "$location",
			"$rootScope", "menuConfig", a
		]).directive("mlMenu", b).directive("mlMenuItem", c).directive("mlMenuGroup",
			d).directive("mlMenuGroupHeading", e).directive("mlMenuTransclude", f).directive(
			"collapse", ["$animate", g])
	}(),
	function() {
		"use strict";

		function a(a) {
			function b(a, b) {
				return b.templateUrl || "some/path/default.html"
			}

			function c(b, c, d) {
				var e = c[0].querySelectorAll("path");
				angular.forEach(e, function(c, d) {
					var e = angular.element(c);
					e.attr("ml-svg-map-region", ""), e.attr("hover-region", "hoverRegion"),
						a(e)(b)
				})
			}
			return {
				restrict: "EA",
				templateUrl: b,
				link: c
			}
		}

		function b(a) {
			function b(b, c, d) {
				b.elementId = c.attr("id"), b.regionClick = function() {
					alert(b.elementId)
				}, b.regionMouseOver = function() {
					b.hoverRegion = b.elementId, c[0].parentNode.appendChild(c[0])
				}, c.attr("ng-click", "regionClick()"), c.attr("ng-attr-fill",
					"{{ elementId | mlSvgMapColor }}"), c.attr("ng-mouseover",
					"regionMouseOver()"), c.attr("ng-class",
					"{ active:hoverRegion == elementId }"), c.removeAttr(
					"ml-svg-map-region"), a(c)(b)
			}
			return {
				restrict: "A",
				scope: {
					hoverRegion: "="
				},
				link: b
			}
		}

		function c() {
			function a() {
				var a = Math.floor(200 * Math.random() + 50),
					b = Math.floor(200 * Math.random() + 50),
					c = Math.floor(200 * Math.random() + 50);
				return "rgba(" + a + "," + b + "," + c + ",1)"
			}
			return a
		}
		angular.module("ml.svg-map", []).directive("mlSvgMap", ["$compile", a]).directive(
			"mlSvgMapRegion", ["$compile", b]).filter("mlSvgMapColor", c)
	}(),
	function() {
		"use strict";

		function a(a, b, c) {
			function d(d) {
				if (this.$scope = d, this.todoFilter = {}, this.activeFilter = 0, this.filters = [{
					title: "All",
					method: "all"
				}, {
					title: "Active",
					method: "active"
				}, {
					title: "Completed",
					method: "completed"
				}], this.newTodo = {
					title: "",
					done: !1,
					editing: !1
				}, this.restore(), !a.get("todos")) {
					var e = [];
					e[0] = {
						title: "Grow my mailing list",
						done: !0
					}, e[1] = {
						title: "Create a killer SAAS business",
						done: !1
					}, e[2] = {
						title: "Write autoresponder sequence",
						done: !1
					}, a.set("todos", e)
				}
				a.bind(this.$scope, "todos"), this.completedTodos = function() {
					return c("filter")(this.$scope.todos, {
						done: !1
					})
				}, this.addTodo = function() {
					"" !== this.todo.title && void 0 !== this.todo.title && (this.$scope.todos
						.push(this.todo), b.$broadcast("todos:count", this.count()), this.restore()
					)
				}, this.updateTodo = function() {
					this.restore()
				}
			}
			return d.prototype.saveTodo = function(a) {
				this.todo.editing ? this.updateTodo() : (this.addTodo(), this.$scope.$broadcast(
					"focusTodoInput"))
			}, d.prototype.editTodo = function(a) {
				this.todo = a, this.todo.editing = !0, this.$scope.$broadcast(
					"focusTodoInput")
			}, d.prototype.toggleDone = function(a) {
				a.done = !a.done, b.$broadcast("todos:count", this.count())
			}, d.prototype.clearCompleted = function() {
				this.$scope.todos = this.completedTodos(), this.restore()
			}, d.prototype.count = function() {
				return this.completedTodos().length
			}, d.prototype.restore = function() {
				this.todo = angular.copy(this.newTodo)
			}, d.prototype.filter = function(a) {
				"active" === a ? (this.activeFilter = 1, this.todoFilter = {
					done: !1
				}) : "completed" === a ? (this.activeFilter = 2, this.todoFilter = {
					done: !0
				}) : (this.activeFilter = 0, this.todoFilter = {})
			}, d
		}

		function b(a) {
			function b(b, c) {
				b.todoService = new a(b)
			}
			return {
				restrict: "EA",
				templateUrl: "tpl/partials/todo-widget.html",
				replace: !0,
				link: b
			}
		}

		function c() {
			return function(a, b, c) {
				a.$on(c.mlTodoFocus, function(a) {
					b[0].focus()
				})
			}
		}
		angular.module("ml.todo", []).factory("TodoService", ["localStorageService",
			"$rootScope", "$filter", a
		]).directive("mlTodoWidget", ["TodoService", b]).directive("mlTodoFocus", c)
	}(),
	function() {
		"use strict";

		function a() {
			function a(a, b, c) {
				var d, e;
				if (d = c.bodyClass || "", e = "string" == typeof c.offset ? parseInt(c.offset
					.replace(/px;?/, "")) : 0, d) {
					var f = document.getElementsByClassName(d),
						g = f.length,
						h = angular.element(f[g - 1]),
						i = b[0].offsetTop,
						j = b[0].clientWidth;
					h.on("scroll", function() {
						h[0].scrollTop > i - e + 30 ? b.css("position", "fixed").css(
								"margin-top", 0).css("top", e + "px").css("max-width", j + "px") :
							b.css("position", "static")
					})
				}
			}
			return {
				restrict: "A",
				link: a
			}
		}
		angular.module("material-lite").directive("mlSticky", a)
	}();