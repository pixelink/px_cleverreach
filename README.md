# TYPO3 CleverReach Newsmailer

The TYPO3 CleverReach allows you to send your regular Pages to the CleverReach System via API functions.

Easy to use, just create a page layout that fullfills the HTML requirements for a Newsletter. Then do some easy settings, type in the CleverReach API key and you are ready to go.
The editors just have to use your newsletter layout and some proper content elements and work like they are used to work within TYPO3.
After all Content Elements are filled, just let them switch to the Newsletter Module, choose their page where the newsletter ist located, define a subject, a internal titel, sender name, sender email and let them choose the CleverReach reciepient group and hit submit.
That's it - so easy to get your Newsletter into CleverReach. The plain text is also done for you.

Now the only have to do the final submit within the CleverReach Dashboard, as this is not allowed via API.

Watch our introduction movie how easy it is to set up the Newsletter and get it up running.


### Best Practice
We recommend to set up a new page root in TYPO3 and define a subdomain like http://newsletter.yourdomain.de.
We also create specific content elements throug fluid content elements (https://github.com/FluidTYPO3/fluidcontent) as they are much easier to maintain for newsletter purposes.

### Version
1.0.2

### Installation

You already found the repo, just download the extension, put it in your typo3conf/ext directory and install via Extension Manager. Then include the extension TypoScript Setup (CleverReach Newsmailer) on your Newsletter root page.

**Constants Setup**
Next define your CleverReach API key and pid for the Newsletter history via constants:
```php
module.tx_pxcleverreach.settings.apiKey = yourApiKeyString
module.tx_pxcleverreach.persistence.storagePid = Page Id where your Newsletter history should be saved
```

**Set baseURL and absRefPrefix**
You need to define baseURl and absRefPrefix - otherwise it will not work
```php
config.baseURL = http://newsletter.yourdomain.dev/
config.absRefPrefix = http://newsletter.yourdomain.dev/
```
### Thx to
Thanks to Lukas Jakob for the initial work on the extension

Pixel Ink - www.pixel-ink.de