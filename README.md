# ACF Block Theme Template

This repository provides a WordPress theme template for developing custom ACF (Advanced Custom Fields) blocks. The theme includes PSR-4 namespacing, SCSS, and TailwindCSS integration. It also comes with three default blocks: Custom Quote Block, Section Anchor Block, and Breadcrumb Block.

## Features

- **Custom ACF Blocks**: Easily create custom blocks using ACF.
- **PSR-4 Namespacing**: Structured and organized codebase with PSR-4 autoloading.
- **SCSS & TailwindCSS**: Style your blocks with SCSS and TailwindCSS.
- **Gulp**: Compile and watch SCSS files with Gulp.
- **Based on _s (Underscores) Theme**: This theme is based on the [Underscores (_s) theme](https://underscores.me/), providing a solid foundation for custom WordPress theme development.

## Default Blocks

1. **Custom Quote Block**
2. **Section Anchor Block**
3. **Breadcrumb Block**

## Minimum Requirements

- **WordPress**: Version 5.0 or higher.
- **Advanced Custom Fields (ACF)**: Version 5.8 or higher.
- **PHP**: Version 7.4 or higher.
- **Node.js**: Version 12 or higher.
- **Composer**

## Installation

1. **Clone the Repository**

   ```sh
   git clone https://github.com/akinsteph/acf-block-theme-template.git
   ```

2. **Search and Replace Placeholders**

   - Replace `ABTTWP` with your namespace.
   - Replace `abtt` and `Abtt` with your theme's text-domain and class names.
   - Replace `ABTT` with your define paths.

3. **Install Composer Dependencies**

   ```sh
   composer install
   ```

4. **Autoload Composer**

   ```sh
   composer dump-autoload
   ```

5. **Install Node.js Dependencies**

   ```sh
   npm install
   ```

6. **Compile SCSS and Watch for Changes**

   ```sh
   npm run dev
   ```

## Usage

### Register a New Block

1. Create a new directory for your block in the `src/Blocks` folder.
2. Add a PHP file for your block (e.g., `src/Blocks/your-block/your-block.php`).
3. Add an SCSS file for your block styles (e.g., `src/Blocks/your-block/your-block.scss`).
4. Register your block using `acf_register_block_type()` in your `src/Blocks/Init.php` PHP file.

### Example: Breadcrumb Block

The Breadcrumb Block is organized in `src/Blocks/abtt-breadcrumb` and includes:

- `abtt-breadcrumb.php`: The PHP file for rendering the block.
- `abtt-breadcrumb.scss`: The SCSS file for styling the block.

### Compile Styles

The theme uses Gulp to compile styles:

- The main theme styles are compiled from `/assets/styles/sass/style.scss` to `/style.css`.
- Block-specific styles are compiled from the `src/Blocks` directory.

To compile styles, run:

```sh
npm run dev
```

## Customization

### Namespace

To change the namespace, search and replace `ABTTWP` in the codebase.

### Text-Domain

To change the text-domain and class names, search and replace `abtt` and `Abtt` in the codebase.

### Define Paths

To change define paths, search and replace `ABTT` in the codebase.

## Important Note

Ensure ACF is installed and activated for the theme to work properly. You can download and activate the ACF plugin from the [WordPress Plugin Repository](https://wordpress.org/plugins/advanced-custom-fields/).

## License

This project is licensed under the MIT License.

## About the Author

**Stephen Akinola**  
*Email*: [stephthedeveloper\[at\]gmail.com](stephthedeveloper@gmail.com)

---

For detailed documentation and advanced usage, refer to the [WordPress Developer Handbook](https://developer.wordpress.org/) and the [ACF Documentation](https://www.advancedcustomfields.com/resources/).

If you have any questions or need further assistance, feel free to open an issue or contact the repository maintainer.

Happy Coding!
