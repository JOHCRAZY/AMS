import 'dart:io';
import 'colors.dart';

void main(final List<String> args) async {
  try {
    if (args.indexOf('-v') != -1) {
      print("${defaults.version}");
      return;
    }
    if (args.indexOf('-h') != -1) {
      print(defaults.options);
      return;
    }
    if (args.isEmpty || args.indexOf('-f') == -1) {
      print('tablecsv:\n${defaults.options}');
      return;
    }
    if (args.length > 1) {
      if (args.indexOf('-nc') != -1 &&
          int.tryParse(args[args.indexOf('-nc') + 1]) != null) {
        defaults.nc = int.parse(args[args.indexOf('-nc') + 1]);
      }

      if (args.indexOf('-nr') != -1 &&
          int.tryParse(args[args.indexOf('-nr') + 1]) != null) {
        defaults.nr = int.parse(args[args.indexOf('-nr') + 1]);
      }

      if (args.indexOf('-nrc') != -1) {
        List<String> nrc = [];
        nrc = args[args.indexOf('-nrc') + 1].split(',');
        if (nrc.length > 1) {
          if (int.tryParse(nrc[0]) != null && int.tryParse(nrc[1]) != null) {
            defaults.nr = int.parse(nrc[0]);
            defaults.nc = int.parse(nrc[1]);
          }
        } else {
          print('${RED}tablecsv: -ncr: invalid argument${RESET}');
          return;
        }
      }
    }
  } catch (e) {
    print(
        '\n${RED}tablecsv: Arguments incorrectly specified${RESET}\n${defaults.options}');
    return;
  }

  try {
    if (!args[args.indexOf('-f') + 1].endsWith('.csv')) {
      print(
          '${RED}tablecsv: [ ${args[args.indexOf('-f') + 1]} ] Not a csv file${RESET}');
      return;
    }
    // Read the CSV file
    File csvFile = File(args[args.indexOf('-f') + 1]);
    List<String> lines = csvFile.readAsLinesSync();
    // Parse the CSV data
    List<List<String>> csvData = [];
    for (String line in lines) {
      csvData.add(line.split(','));
    }

    List<String> table =
        await tabulateCsv(csvData, args[args.indexOf('-f') + 1]);
    // Print the data in table format
    if (true) {
      for (var row in table) {
        print('${row}');
      }
    }
    try {
      if (args.indexOf('-o') != -1) {
        File txtFile = File('${args[args.indexOf("-o") + 1]}');
        for (String row in table) {
          await txtFile.writeAsString('${row}\n',
              flush: true, mode: FileMode.writeOnlyAppend);
        }
      }
    } catch (e) {
      print('${RED}tablecsv: -o: Output file not Specified${RESET}\n');
    }
  } catch (e) {
    if (e.toString().contains('PathNotFoundException:')) {
      print(
          "${RED}${e.toString().replaceFirst('PathNotFoundException', 'tablecsv').replaceFirst('OS Error', '${args[args.indexOf('-f') + 1]}')}${RESET}");
      return;
    }
    if (e.toString().contains('index')) {
      print('No .csv file specified');
      return;
    }
  }

  return;
}

Future<List<String>> tabulateCsv(
    List<List<String>> data, String fileName) async {
  List<String> tabulated = [];
  String line = '';

  // Find the maximum width of each column
  List<int> columnWidths = [];
  for (List<String> row in data) {
    for (int i = 0; i < row.length; i++) {
      if (row[i] == '' || row[i] == '~') {
        row[i] = 'NA';
      }
      if (columnWidths.length <= i) {
        columnWidths.add(0);
      }
      if (row[i].length > columnWidths[i]) {
        columnWidths[i] = row[i].length;
      }
    }
  }

  if (defaults.nc! == 0) return tabulated;
  tabulated.add('${fileName.padLeft(defaults.nc! * 5, ' ')}');
  int nrc = 0;
  for (List<String> row in data) {
    String rowString = '| ';
    String separator = '+-';
    if (defaults.nc! > row.length) defaults.nc = row.length;
    for (int i = 0; i < defaults.nc!; i++) {
      // Pad each cell to match the column width
      rowString += row[i].padRight(columnWidths[i] + 2) + '| ';
      separator += '-'.padRight(columnWidths[i] + 2, '-') + '+-';
    }
    line = separator.substring(0, separator.length - 1);
    tabulated.add(line);
    tabulated.add(rowString);

    if (defaults.nr == nrc) {
      tabulated.add('${line}\n\n');
      return tabulated;
    }
    nrc++;
  }
  tabulated.add('${line}\n\n');
  return tabulated;
}

class defaults {
  static String version = 'tablecsv: version: v1.0.0';
  static int? nc = 10;
  static int? nr = 20;
  static String options = '\n\tUsage: tablecsv [arguments] <filepath> \n\n'
      'Available arguments:'
      '\n\t  -f \t\tSpecify a .csv file or path'
      '\n\t  -h \t\tDisplay this usage information'
      '\n\t  -nc \t\tSpecify the number of columns [ie, default: -nc 10]'
      '\n\t  -nr \t\tSpecify the number of rows [ie, default: -nr 20]'
      '\n\t  -nrc \t\tSpecify the number of rows and columns [ie: -nrc 10,5]'
      '\n\t  -o \t\tSpecify the output file'
      '\n\t  -v \t\tprint the version of tablecsv\n';
}
