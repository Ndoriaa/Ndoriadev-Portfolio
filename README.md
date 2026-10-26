# Victor Ndoria portfolio

PHP builds the pages; the site you deploy is plain static HTML.

## Run locally
1. `php build.php`  (writes the site into `dist/`)
2. `php -S localhost:8000 -t dist`  then open the address it prints, then add /index.html

## Edit
- Pages: `src/pages/{dev,creative}/*.php (two separate sides) and src/pages/index.php (start page)`   Shared parts: `src/partials/`
- Projects: add an entry to `src/data/projects.json`, rebuild
- Styles: `assets/css/style.css`   Put your CV at `assets/Victor_Ndoria_CV.pdf`
- Contact form: replace `YOUR_FORM_ID` in `src/pages/contact.php` with your Formspree form ID

## Deploy free on Vercel
Vercel cannot run PHP, so build first and commit `dist/` to GitHub. Import the repo in Vercel; `vercel.json` sets the output folder and no build command. Rebuild, commit and push to update.
