##############################################################################
# "NConf" library
# A collection of shared functions for the NConf Perl scripts.
# Global vars defined here.
#
# Version 0.2
# Written by Angelo Gargiulo
#
# Revision history:
# 2009-02-25 v0.1   A. Gargiulo   First release
# 2009-10-08 v0.2   A. Gargiulo   Merged generate_config with NConf perl-API
#
##############################################################################

package NConf;
use strict;
use Exporter;
use FindBin;

# GLOBAL CONSTANTS
use constant NC_CONFDIR  => "$FindBin::Bin/../config";

# GLOBAL VARS
use vars qw($NC_loglevel %NC_macro_values);
$NC_loglevel = 3;

##############################################################################
### I N I T ##################################################################
##############################################################################

BEGIN {
    use vars qw(@ISA @EXPORT @EXPORT_OK $VERSION $AUTHOR $COPYRIGHT);
 
    @ISA         = qw(Exporter);
    @EXPORT      = qw($NC_loglevel %NC_macro_values NC_CONFDIR setLoglevel);
    @EXPORT_OK   = qw();
    $VERSION     = 0.2;
    $AUTHOR      = "A. Gargiulo";
    $COPYRIGHT   = "(c) 2006-2009 Sunrise Communications AG, Zurich, Switzerland";
}

print "\n";
print "[ Initializing NConf perl-API (library version $VERSION, written by $AUTHOR) ]\n";
print "[ Copyright $COPYRIGHT    ]\n\n";

#print "[ DISCLAIMER: This library is BETA and comes with ABSOLUTELY NO WARRANTY of any kind! ]\n";
#print "[ Syntax may be subject to change in the future!                                      ]\n\n";

##############################################################################
### S U B S ##################################################################
##############################################################################

sub setLoglevel {

    # SUB use: Set the overall loglevel

    # SUB specs: ###################

    # Expected arguments:
    # 0: The loglevel to set (1-5)

    ################################

    my $loglevel = shift;

    if($loglevel >= 1 && $loglevel <= 5){
        $NC_loglevel = $loglevel;
    }
}

1;

__END__

}
