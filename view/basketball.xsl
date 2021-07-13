<?xml version="1.0" encoding="utf-8"?> 
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0" >
<xsl:output method="xml" version="1.0" omit-xml-declaration="yes" indent="yes" media-type="text/html"/>
    
<xsl:template match="/">
	<!-- <xsl:element name="h4">
    <xsl:value-of select="rss/channel/title" />
  </xsl:element> -->
  <xsl:apply-templates select="rss/channel/copyright" />
  <xsl:apply-templates select="rss/channel/description[1]" />
  <xsl:apply-templates select="rss/channel/item[position()&lt;6]" />
</xsl:template>


  <xsl:template match="rss/channel/copyright">
    <xsl:element name="h3">
      <xsl:value-of select="." /><br/>
    </xsl:element>
  </xsl:template>

  <xsl:template match="rss/channel/description[1]">
    <xsl:value-of select="." /><br/><br/>
  </xsl:template>
  
  <xsl:template match="rss/channel/item">
    <xsl:element name="div">
      <xsl:attribute name="class">card</xsl:attribute>
      <xsl:element name="div">
        <xsl:attribute name="class">card-body</xsl:attribute>
          <xsl:value-of select="pubDate[1]" /><br/>
          <xsl:element name="h5">
            <xsl:attribute name="class">card-title</xsl:attribute>
            <xsl:value-of select="title[1]" /><br/>
          </xsl:element>
          <xsl:element name="p">
            <xsl:attribute name="class">card-text</xsl:attribute>
            <xsl:value-of select="description[1]" /><br/>
          </xsl:element>
      </xsl:element>
    </xsl:element><br/>
  </xsl:template>


</xsl:stylesheet>
