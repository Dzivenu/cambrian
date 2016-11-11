# cambrian

Cambrian is a file-system based modular CMS

It serves static HTML pages from `/pages/$url/content.html` at `/$url`

## Usage
edit `/config/main.php` according to your needs

Set up the layout by overwriting files from the core module, use `<?= $this->data['content'] ?>` for the content

Overwrite any file from a module's `./layout/html/` using an own file - for example for the page header `/layout/html/mod_core_header.html`

add some folders for pages containing content files, analog to `/pages/home`

## Current module set
### core
  - overwrite module layout files
  - routing for pages

### navigation
  - pages: see `/modules/core/layout/html/header.html` for example use 

### csscrush
  - depends on `/vendors/css-crush`, included in git submodules
