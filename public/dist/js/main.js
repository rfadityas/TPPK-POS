/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ (() => {

eval("const themeSwitch = document.querySelector(\"#theme-switcher\");\n\nif (\n  localStorage.theme === \"dark\" ||\n  (!(\"theme\" in localStorage) &&\n    window.matchMedia(\"(prefers-color-scheme: dark)\").matches)\n) {\n  document.documentElement.setAttribute(\"data-theme\", \"dark\");\n  themeSwitch.checked = false;\n} else {\n  document.documentElement.setAttribute(\"data-theme\", \"light\");\n  themeSwitch.checked = true;\n}\n\nthemeSwitch.addEventListener(\"click\", () => {\n  if (document.documentElement.getAttribute(\"data-theme\") === \"dark\") {\n    document.documentElement.setAttribute(\"data-theme\", \"light\");\n    localStorage.theme = \"light\";\n  } else {\n    document.documentElement.setAttribute(\"data-theme\", \"dark\");\n    localStorage.theme = \"dark\";\n  }\n});\n\n\n//# sourceURL=webpack://my-webpack-project/./src/index.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/index.js"]();
/******/ 	
/******/ })()
;