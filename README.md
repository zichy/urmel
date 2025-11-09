# urmel

*urmel* is minimalist blog software. It can be used for microblogging, linkblogging and longer texts.

## Features

- Interface to draft, publish, edit, and delete posts
- [Text formatting](#text-formatting)
- Flat-file; no database needed
- [Simple installation](#installation)
- Atom feed
- Open Graph tags & Microdata
- Zero dependencies

## Missing features

- WYSIWYG editor
- Embedded media
- Comments, webmentions
- ActivityPub
- Composer package

## Target audiences

- Hackers — It’s easy to customise.
- Hipsters — It’s crappy, you could use it as a joke.

## Requirements

- PHP >= 8.4.0
- SSL/TLS certificate

## Installation

1. Update `config.php.sample` and rename it to `config.php`.
    - Optionally, you can translate all text strings in `classes/l10n.php`.
2. Upload everything to a web server. (Yes, this is old-school.)
3. It should work.

Use your credentials at `?login` to access the editor panel.

## Text formatting

There is some [Markdown](https://daringfireball.net/projects/markdown/)-inspired formatting.

| Input                          | Output                                          |
| ---                            | ---                                             |
| `**strong**`                   | **strong**                                      |
| `_italic_`                     | _italic_                                        |
| `~~strikethrough~~`            | ~~strikethrough~~                               |
| `>quotation block`             | <blockquote><p>quotation block</p></blockquote> |
| `@code@`                       | `code`                                          |
| `[https://example.org]`        | https://example.org                             |
| `[title](https://example.org)` | [title](https://example.org)                    |

## License

*urmel* is licensed under the [EUPL 1.2](https://eupl.eu/1.2/en/).
