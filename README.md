# PHP agreement and ID-card generator

A PHP web project containing form submission, agreement and ID-card generation, PDF output, and download endpoints. The Composer manifest includes TCPDF and mPDF dependencies.

## Repository guide

| Path | Purpose |
| --- | --- |
| [index.php](index.php) | Main entry page |
| [submit.php](submit.php) | Form-submission handler |
| [agreements.php](agreements.php) | Agreement-related page |
| [generate_pdf.php](generate_pdf.php) | PDF generation code |
| [download.php](download.php) | Download handler |
| [download_agreement.php](download_agreement.php) | Agreement download handler |
| [composer.json](composer.json) | PDF-library requirements |

## Review and run locally

```sh
git clone https://github.com/Priyanshu845438/agreement-generator.git
cd agreement-generator
```

Review the PHP requirements in `composer.lock`, the application’s database configuration, and the form-handling paths before starting a local development server. Use your own local database settings and synthetic form data. Install dependencies with Composer in a compatible development environment.

The documentation update did not execute PDF generation or database operations. Review existing project and dependency licensing before reuse.

## More projects

Explore [Priyanshu Raj’s public repositories](https://github.com/Priyanshu845438/Priyanshu845438/blob/main/PUBLIC-REPOSITORIES.md) or [follow the GitHub profile](https://github.com/Priyanshu845438) for updates.
