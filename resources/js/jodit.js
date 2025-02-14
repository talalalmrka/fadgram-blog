import { Jodit } from "jodit";

document.addEventListener('DOMContentLoaded', function () {
    const joditTextarea = document.querySelectorAll('.jodit');
    joditTextarea.forEach(function (textarea) {
        const editor = Jodit.make(textarea, {
            "autofocus": true,
            "toolbarSticky": true,
            "uploader": {
                "insertImageAsBase64URI": true
            },
            "toolbarButtonSize": "xsmall",
            "showCharsCounter": false,
            "showWordsCounter": false,
            "showXPathInStatusbar": false,
            "defaultActionOnPaste": "insert_clear_html",
            "height": textarea.dataset.height ?? 400,
        });
    });
});