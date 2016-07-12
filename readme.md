# Blank Wordpress theme

Blank is bareone Wordpress theme with:
 
- HTML5, CSS
- [Webpack](https://webpack.github.io/)
- [Boostrap](http://getbootstrap.com/)

## How to install theme

```bash
composer create-project om/blank wp-content/themes/blank -s dev
# remove .git folder in next step
cd wp-content/themes/blank
npm install && composer install && webpack
```