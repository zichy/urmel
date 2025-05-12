# urmel

*urmel* is brutalist and flat-file microblogging software. It's the spiritual successor to [vicco](https://github.com/zichy/vicco).

## Features

- Web interface to draft, publish, edit, and delete posts
- [Text formatting](#text-formatting)
- Atom feed
- Open Graph, Microdata

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

- Web server with PHP
- SSL/TLS certificate

## Installation

1. Update `config.json.sample` and rename it to `config.json`.
    - Optionally, you can translate all text strings in `classes/l10n.php`.
2. Upload everything to a web server. (Yes, this is old-school.)
3. Use your credentials at `?login` to access the editor panel.

## Text formatting

There is some [Markdown](https://daringfireball.net/projects/markdown/)-inspired formatting.

| Input                          | Output                                          |
| ---                            | ---                                             |
| `**strong**` / `__strong__`    | __strong__                                      |
| `*italic*` / `_italic_`        | _italic_                                        |
| `~~strikethrough~~`            | ~~strikethrough~~                               |
| `>quotation block`             | <blockquote><p>quotation block</p></blockquote> |
| `@code@`                       | `code`                                          |
| `[https://example.org]`        | https://example.org                             |
| `[title](https://example.org)` | [title](https://example.org)                    |

## License

*urmel* is licensed under the [EUPL 1.2](https://eupl.eu/1.2/en/).
