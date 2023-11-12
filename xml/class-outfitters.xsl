<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <body>
                <table style="width:80%;">
                    <tr style="background-color:orange;">
                        <th>First Name</th>
                        <th>Middle Name</th>
                    </tr>
                    <xsl:for-each select="shop/collection/product">
                        <tr>
                            <td style="width: 50%;">
                                <xsl:value-of select="name" />
                            </td>
                            <td style="width: 50%;">
                                <img src="{images/productZoomImage}" style="height: 90px; width: 120px;" />
                            </td>
                        </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>